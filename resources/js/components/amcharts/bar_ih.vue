<template>
    <div>
        <div v-if="preloading != 'none' && !hasData" :style="{height: altura + 'px'}">
            <div class="text-center font-24 vertical-align-middle" :style="{'margin-top': halfsize + 'px'}">
                <i class="fa fa-spinner fa-spin"></i> {{ (preloading == '')? "Cargando datos ...": preloading }}
            </div>
        </div>
        <div :id="keyname" ref="chartdiv" :class="(preloading != 'none' && !hasData)? 'hide': ''" :style="{height: lc_altura + 'px'}"></div>
        <div class="alert alert-warning mt-2" v-if="overload">
            <div class="d-flex">
                <i class="fa fa-warning me-2"></i>
                <span>Hay demasiados datos para graficar! (Más de 50).</span>
            </div>
        </div>
    </div>
</template>
<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);

export default {
    props: {
        altura: {type: String, default: "300"},
        multicolor: {type: Boolean, default: false},
        manual: {type: Boolean, default: false},
        ordenado: {type: Boolean, default: false},
        redondeado: {type: Boolean, default: false},
        apilado: {type: Boolean, default: false},
        leyenda: {type: String, default: 'none'},
        sin_leyenda: {type: Boolean, default: false},
        ruta: {type: String, default: 'none'},
        contexto: {type: String, default: 'datos'},
        campo_categoria: {type: String, default: 'categoria'},
        campo_valor: {type: String, default: 'valor'},
        alfa: {type: String, default: '1'},
        etiquetas: {type: Boolean, default: false},
        lanzarevento: {type: String, default: 'none'},
        muestra: {type: Boolean, default: false},
        titulo_eje: {type: String, default: 'none'},
        titulo_categoria: {type: String, default: 'none'},
        preloading: {type: String, default: 'none'},
        min: {type: String, default: "none"},
        max: {type: String, default: "none"},
        paleta: {type: String, default: "basica"},
        grosor: {type: String, default: "none"},
        suave: {type: Boolean, default: false},
        puntos: {type: Boolean, default: false},
        rotar: {type: Boolean, default: false},
        cursor: {type: Boolean, default: false},
        grilla: {type: String, default: '0.1'},
        horizontal: {type: Boolean, default: false},
        sin_valores: {type: Boolean, default: false},
        tooltip: {type: Boolean, default: false},
        custom: {type: String, default: ''},
        pretag: {type: String, default: ''},
        // empty_data: {type: String, default: ''},
        empty_category: {type: String, default: ''},
        truncar: {type: Boolean, default: false},
        enfocar: {type: Boolean, default: false},
    },
    data(){
        return {
            view:{type:String, default:false},
            keyname: '_am4_' + Math.random().toString().replace("0.", ""),
            lc_altura: 0,
            lc_grilla: 0.1,
            lc_custom: this.custom,
            lc_pretag: this.pretag,
            lc_campo_valor: '',
            chart: null,
            datos: [],
            ejeCategorias: null,
            ejeValores: null,
            listSeries: [],
            boxSeries: [],
            txleyendas: [],
            boxTypes: [],
            paletas: {
                basica: ["#67b7dc", "#6794dc", "#6771dc", "#8067dc", "#a367dc", "#c767dc", "#dc67ce", "#dc67ab", "#dc6788", "#dc6967", "#dc8c67", "#dcaf67", "#dcd267", "#c3dc67", "#a0dc67", "#7ddc67", "#67dc75", "#67dc98", "#67dcbb", "#67dadc"],
                material: ["#f44336", "#e91e63", "#9c27b0", "#673ab7", "#3f51b5", "#2196f3", "#03a9f4", "#00bcd4", "#009688", "#4caf50", "#8bc34a", "#cddc39", "#ffeb3b", "#ffc107", "#ff9800", "#ff5722", "#795548", "#9e9e9e", "#607d8b"],
                dataviz: ["#283250", "#902c2d", "#d5433d", "#f05440", "#f05440", "#f26958", "#f47e6f", "#f69487", "#f7a99f", "#f9beb6", "#fbd3ce", "#d32711", "#eb2b12", "#741509", "#8c1a0b", "#a41e0d", "#bb220f", "#741509", "#8c1a0b", "#a41e0d", "#bb220f", "#d32711", "#eb2b12", "#ee3f28"],
                kelly: ["#f3c300", "#875692", "#f38400", "#a1caf1", "#be0032", "#c2b280", "#848482", "#008856", "#e68fac", "#0067a5", "#f99379", "#604e97", "#f6a600", "#b3446c", "#dcd300", "#882d17", "#8db600", "#654522", "#e25822", "#2b3d26", "#f2f3f4", "#222222"],
                frozen: ["#bec4f8", "#a5abee", "#6a6dde", "#4d42cf", "#713e8d", "#a160a0", "#eb6eb0", "#f597bb", "#fbb8c9", "#f8d4d8"],
                moonrise: ["#3a1302", "#601205", "#8a2b0d", "#c75e24", "#c79f59", "#a4956a", "#868569", "#756f61", "#586160", "#617983"],
                custom: [],
            },
            themePaleta: '',
            _accion: null,
            hasData: false,
            halfsize: 0,
            isCreated: false,
            overload: false,
        }
    },
    methods: {
        isEmpty: function(arg){
            return ['', null, undefined].includes(arg);
        },
        exportar: function(){
            if(this.chart != null){
                this.chart.exporting.export("png");
            }
        },
        getTypeSerie: function(arg){
            return (["columna", "linea"].indexOf(arg) > -1)? arg: "columna";
        },
        setFocusBar: function(index){
            let opaque = (index == -1)? 1: 0.3;
            this.chart.series.values[0].columns.values.forEach((elm, i) => {
                if(index == i){
                    elm.fillOpacity = 1;
                }else{
                    elm.fillOpacity = opaque;
                }
            });
        },
        resetFocus: function(){
            this.setFocusBar(-1);
        },
        setAccion: function(arg){
            this._accion = arg;
        },
        setPaleta: function(arg){
            if(arg == '' || arg == undefined){
                this.themePaleta = 'basica';
            }else if(['basica', 'material', 'dataviz', 'kelly', 'frozen', 'moonrise'].indexOf(arg) > -1){
                this.themePaleta = arg;
            }else if(/^\d+$/.test(arg)){
                let plt = ['basica', 'basica', 'material', 'dataviz', 'kelly', 'frozen', 'moonrise'];
                let num = parseInt(arg);
                this.themePaleta = (num > 0 && num < 7)? plt[num]: 'basica';
            }else if(/#/.test(arg)){
                this.paletas.custom = arg.split(',');
                this.themePaleta = 'custom';
            }else{
                this.themePaleta = 'basica';
            }
        },
        setColor: function(arg){
            if(this.isCreated){
                if(this.boxSeries.length == 1){
                    this.boxSeries.forEach(serie => {
                        serie.columns.template.adapter.add('fill', (fill, target) => new am4core.color(arg));
                    });
                }
            }
        },
        getPaleta: function(){
            return this.paletas[this.themePaleta];
        },
        loadRuta: function(){
            if(this.ruta != 'none'){
                axios.get(this.ruta).then(response => {
                    this.setDatos(response.data[this.contexto])
                }).catch(err => {console.log(err)});
            }
        },
        setDatos: function(arg, campo_valor_ih=''){
            if(this.manual){
                this.listSeries = [];
                if(campo_valor_ih != ''){
                    this.lc_campo_valor = campo_valor_ih;
                    this.lc_campo_valor.split(',').forEach(elm => {
                        var tm = elm.split(':');
                        this.listSeries.push(tm[0]);
            
                        (tm.length > 1)? this.txleyendas.push(tm[1]): this.txleyendas.push(tm[0]);
                        (tm.length > 2)? this.boxTypes.push(this.getTypeSerie(tm[2])): this.boxTypes.push(this.getTypeSerie("columna"));
                    });
                    this.createChart();
                    this.loadRuta();
                }
            }
            // this.datos = arg;
            // if(panel != 'none'){
            //     arg.length == 0? this.visualizar(panel,false): this.visualizar(panel,true); 
            // }
            if(Array.isArray(arg)){
                if(arg.length > 50){
                    this.overload = true;
                    this.datos = (this.empty_category == '')? arg.slice(0, 50): arg.slice(0, 50).map(elm => {
                        if(this.isEmpty(elm[this.campo_categoria])){
                            elm[this.campo_categoria] = this.empty_category;
                        }
                        return elm;
                    });
                }else{
                    this.overload = false;
                    this.datos = (this.empty_category == '')? arg: arg.map(elm => {
                        if(this.isEmpty(elm[this.campo_categoria])){
                            elm[this.campo_categoria] = this.empty_category;
                        }
                        return elm;
                        
                    });
                    // console.log(panel+'--------------------');
                    // console.log(this.datos);
                }
                let ckey = this.listSeries[0];
                if(this.ordenado){
                    this.datos = this.datos.sort((a, b) => b[ckey] - a[ckey]);
                }
                if(this.isCreated){
                    this.chart.data = this.datos;
                    this.runAnimate();
                }
                this.hasData = true;
            }else{
                console.log('Esto no es un array:');
                console.log(arg);
            }
        },
        runAnimate: function(){
            if(this.chart != null){
                this.chart.appear();
                this.chart.series.each(function(series) {
                    series.appear();
                });
            }
        },
        loadingStatus: function(){
            this.setDatos([]);
            this.hasData = false;
        },
        preview: function(){
            let a = ["Colombia", "Brasil", "Argentina", "Perú", "Ecuador", "Venezuela", "Chile", "Paraguay", "Uruguay", "Bolivia", "Japón", "Korea"];
            let b = [];
            let ckey = this.listSeries[0];
            a.forEach(elm => {
                let dt = new Object();
                dt[this.campo_categoria] = elm;
                dt[ckey] = Math.round(Math.random() * 100 + 70);
                b.push(dt);
            });
            this.setDatos(b);
        },
        createChart: function(){
            let colorSet = new am4core.ColorSet();
            colorSet.list = this.getPaleta().map(col => new am4core.color(col));
            
            this.chart = am4core.create(this.$refs.chartdiv, am4charts.XYChart);
            this.chart.colors = colorSet;
            this.chart.data = this.datos;
            if(! this.sin_leyenda){
                if(this.leyenda != 'none'){
                    this.chart.legend = new am4charts.Legend();
                    this.chart.legend.position = (this.leyenda == '')? 'top': this.leyenda;
                }else if(this.listSeries.length > 1){
                        this.chart.legend = new am4charts.Legend();
                        this.chart.legend.position = 'top';                
                }
            }

            this.ejeCategorias = this.chart.xAxes.push(new am4charts.CategoryAxis());
            this.ejeCategorias.dataFields.category = this.campo_categoria;
            this.ejeCategorias.renderer.grid.template.strokeOpacity = this.lc_grilla;
            this.ejeCategorias.fontFamily = 'Arial';
            this.ejeCategorias.renderer.minGridDistance = 20;
            //this.ejeCategorias.renderer.grid.template.disabled = true;    Oculta la línea
            if(this.rotar){
                this.ejeCategorias.renderer.labels.template.horizontalCenter = "right";
                this.ejeCategorias.renderer.labels.template.verticalCenter = "middle";
                this.ejeCategorias.renderer.labels.template.rotation = 270;                
            }
            if(this.truncar){
                // this.ejeCat.renderer.labels.template.wrap = true;
                this.ejeCategorias.renderer.labels.template.truncate = true;
                this.ejeCategorias.renderer.labels.template.maxWidth = 120;
            }

            /*this.ejeCategorias.events.on("sizechanged", function(ev) {
                let axis = ev.target;
                var cellWidth = axis.pixelWidth / (axis.endIndex - axis.startIndex);
                if (cellWidth < axis.renderer.labels.template.maxWidth) {
                    alert('in rotation');
                    axis.renderer.labels.template.rotation = 270;
                    axis.renderer.labels.template.horizontalCenter = "right";
                    axis.renderer.labels.template.verticalCenter = "middle";
                }else{
                    alert('else rotation');
                    axis.renderer.labels.template.rotation = 0;
                    axis.renderer.labels.template.horizontalCenter = "middle";
                    axis.renderer.labels.template.verticalCenter = "top";
                }
            });*/
            if(this.titulo_categoria != 'none'){
                this.ejeCategorias.title.text = this.titulo_categoria;
            }
            //this.ejeCategorias.tooltip.disabled = true;
            this.ejeCategorias.renderer.grid.template.location = 0;
            if(this.listSeries.length > 1 && !this.apilado){
                this.ejeCategorias.renderer.cellStartLocation = 0.1;
                this.ejeCategorias.renderer.cellEndLocation = 0.9;
            }

            this.ejeValores = this.chart.yAxes.push(new am4charts.ValueAxis());
            this.ejeValores.renderer.grid.template.strokeOpacity = this.lc_grilla;
            this.ejeValores.cursorTooltipEnabled = false;
            this.ejeValores.fontFamily = 'Arial';
            if(this.sin_valores) this.ejeValores.renderer.labels.template.disabled = true;
            if(this.min != "none") this.ejeValores.min = parseInt(this.min);
            if(this.max != "none"){
                this.ejeValores.max = parseInt(this.max);
            }else{
                this.ejeValores.extraMax = 0.2;
            }
            if(this.titulo_eje != 'none'){
                this.ejeValores.title.text = this.titulo_eje;
            }
            this.listSeries.forEach((elm, indice) => {
                let boxType = this.boxTypes[indice];
                let serie = (boxType == 'columna')? this.chart.series.push(new am4charts.ColumnSeries()): this.chart.series.push(new am4charts.LineSeries());
                serie.name = this.txleyendas[indice];
                serie.dataFields.categoryX = this.campo_categoria;
                serie.dataFields.valueY = elm;
                //serie.tooltipText = elm + ": {values.valueY.value}";
                //serie.columns.template.strokeWidth = 2;
                //serie.columns.template.fillOpacity = this.alfa;
                //serie.columns.template.width = am4core.percent(100);
                if(boxType == 'columna'){
                    //serie.columns.template.tooltipText = this.txleyendas[indice] + ": {valueY}";
                    serie.columns.template.strokeOpacity = 0;
                    if(this.tooltip){
                        serie.columns.template.tooltipText = this.lc_custom == ''? this.txleyendas[indice] + ": {valueY}": this.lc_custom;
                        serie.columns.template.tooltipY = 0;
                        serie.tooltip.pointerOrientation = 'down';
                        // serie.tooltip.keepTargetHover = true;
                        serie.tooltip.dy = 0;
                        if(this.lanzarevento != 'none'){
                            serie.tooltip.label.interactionsEnabled = true;
                            serie.tooltip.keepTargetHover = true;
                            serie.tooltip.events.on('hit', ev => {
                                let contexto = ev.target.dataItem.dataContext;
                                contexto.campo_categoria = this.campo_categoria;
                                contexto.lc_campo_valor = elm;
                                if(this.empty_category != '' && contexto[this.campo_categoria] == this.empty_category){
                                    contexto[this.campo_categoria] = "";
                                }
                                this.$eventBus.$emit(this.lanzarevento, contexto);
                                if(this.enfocar){
                                    this.setFocusBar(ev.target.dataItem.index);
                                }
                            });
                        }
                    }
                    if(this.apilado){
                        serie.stacked = true;
                    }
                    if(this.redondeado){
                        serie.columns.template.column.cornerRadiusTopRight = 10;
                        serie.columns.template.column.cornerRadiusTopLeft = 10;
                    }
                    if(this.multicolor && this.listSeries.length == 1){
                        serie.columns.template.adapter.add('fill', (fill, target) => this.chart.colors.getIndex(target.dataItem.index));
                    }
                    serie.columns.template.events.on("hit", ev => {
                        var contexto = ev.target.dataItem.dataContext;
                        if(this._accion != null){
                            this._accion(contexto);
                        }
                        if(this.lanzarevento != 'none'){
                            var tm = contexto;
                            tm.campo_categoria = this.campo_categoria;
                            tm.lc_campo_valor = elm;
                            if(this.empty_category != '' && tm[this.campo_categoria] == this.empty_category){
                                tm[this.campo_categoria] = "";
                            }
                            this.$eventBus.$emit(this.lanzarevento, tm);
                        }
                        if(this.enfocar){
                            this.setFocusBar(ev.target.dataItem.index);
                        }
                    });
                }else if(boxType == 'linea'){
                    if(this.suave) serie.tensionX = 0.77;
                    if(this.grosor != "none") serie.strokeWidth = parseInt(this.grosor);
                    if(this.puntos){
                        var bullet = serie.bullets.push(new am4charts.CircleBullet());
                        bullet.tooltipText = this.txleyendas[indice] + ": {valueY}";
                        bullet.circle.fill = am4core.color("#FFF");
                        bullet.circle.strokeWidth = (this.grosor != "none")? parseInt(this.grosor): 1;
                    }
                }
                if(this.etiquetas){
                    let tag = serie.bullets.push(new am4charts.LabelBullet());
                    tag.label.text = this.lc_pretag + "{valueY}";
                    if(boxType == 'columna'){
                        tag.label.verticalCenter = "bottom";
                        if(this.apilado) tag.locationY = 0.5;
                    }else if(boxType == 'linea'){
                        tag.label.dy = -10;
                    }
                }
                this.boxSeries.push(serie);
            });
            if(this.cursor){
                var cursor = new am4charts.XYCursor();
                this.chart.cursor = cursor;
                cursor.lineX.disabled = true;
                cursor.lineY.disabled = true;
                cursor.behavior = "none";
            }
            this.isCreated = true;
        },

        visualizar: function(pnl, opc){
            let data = {'panel':pnl,'opcion':opc};
            this.$eventBus.$emit('visualizador',data);
        }
    },
    mounted(){
        //alert(this.$refs);
        console.log(this.$refs);
        this.setPaleta(this.paleta);
        this.lc_grilla = parseFloat(this.grilla);
        this.lc_altura = parseInt(this.altura);
        this.halfsize = this.lc_altura * 0.5;
        if(this.manual == false){
            this.lc_campo_valor = this.campo_valor;
            this.lc_campo_valor.split(',').forEach(elm => {
                var tm = elm.split(':');
                this.listSeries.push(tm[0]);
    
                (tm.length > 1)? this.txleyendas.push(tm[1]): this.txleyendas.push(tm[0]);
                (tm.length > 2)? this.boxTypes.push(this.getTypeSerie(tm[2])): this.boxTypes.push(this.getTypeSerie("columna"));
            });
            this.createChart();
            this.loadRuta();
        }

        if(this.muestra){
            this.preview();
        }
    }
}
</script>