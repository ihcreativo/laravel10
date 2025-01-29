<template>
    <div :class="status">
        <div class="py-0 my-0">
            <div class="my-0 py-0">
                <div class="my-0 py-0">
                <div class="me-auto bd-highlight py-0 my-0 align-middle">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0 ms-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                            <a :href="path+'/ausentismo'"> AUSENTISMO</a> - <span class="fw-bold">  CARACTERIZACION EMPRESARIAL </span>
                        </h6>
                        <div class="h6 my-0">
                            <a :href="path+'/ausentismo'" class="bg-dark text-white rounded px-2 py-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                <i class="fa-solid fa-bars"></i>
                            </a>
                            <div class="dropdown-menu py-3 px-1 widget-content widget-content-area" aria-labelledby="btndefault">
                                <div class="text-center py-2 fw-bold">
                                    CARACTERIZACIONES
                                </div>    
                                <a :href="path+'/caracterizacion-personal'" class="dropdown-item rounded py-2 small">
                                    <i class="fa-solid fa-user"></i>
                                    Caracterizacion personal
                                </a>
                                <a :href="path+'/caracterizacion-empresarial'" class="dropdown-item rounded py-2 small">
                                    <i class="fa-solid fa-building"></i>
                                    Caracterización empresarial
                                </a>
                                <a :href="path+'/caracterizacion-periodo-time'" class="dropdown-item rounded py-2 small">
                                    <i class="fa-solid fa-clock"></i>
                                    Periodo de tiempo
                                </a>
                                <a :href="path+'/caracterizacion-ubicacion-geografica'" class="dropdown-item rounded py-2 small">
                                    <i class="fa-solid fa-location-dot"></i>
                                    Ubicación geográfica
                                </a>
                                <a :href="path+'/caracterizacion-impacto-economico'" class="dropdown-item rounded py-2 small">
                                    <i class="fa-solid fa-coins"></i>
                                    Impacto económico
                                </a>
                            </div>
                        </div> 
                    </div>
                </div>  
            </div>

            </div>
            <div class="input-group border-0 mb-2" style="cursor: pointer;">
                <div :class="showMenu == gr.id? 'form-control text-center btn btn-dark':'form-control text-center btn btn-gray'" @click="selectOpcion(gr)" v-for="(gr,i) in menu" :key="i">
                    <button  class="btn bg-white btn-icon mb-0  btn-rounded">
                        <i v-if="showMenu == gr.id" class="fa-regular fa-folder-open h5 py-0 px-0 mx-0 my-0"></i>
                        <i v-else class="fa-solid fa-folder h5 py-0 px-0 mx-0 my-0"></i>
                    </button>
                    {{ gr.opcion }}
                </div>
            </div>
            <div class="row mx-0">
                <div :class="!filtroShow ? 'col-12 px-0 mx-0 py-1 text-sm-end':'d-none'">
                    <span class="badge badge-dark" @click="filtroShow = true" style="cursor: pointer;">
                        FILTRO
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
                            <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                        </svg>
                    </span>
                </div>
                <div :class="filtroShow ? 'col-12 px-0 mx-0 py-1 text-sm-end':'d-none'">
                    <span class="badge badge-danger" @click="filtroShow = false" style="cursor: pointer;">
                        X
                    </span>
                </div>
                 
                <div :class="filtroShow ? 'col-12 px-0 mx-0 py-0':'d-none'">
                    <!-- d-flex justify-content-between   -->
                    <div class="widget  mb-3 px-3 py-3 mt-1 bg-white">
                        <div class="row">
                            <div class="col-5">
                                <h5>Seleccionar años</h5>
                                <div class="form-check form-check-inline" v-for="(x, index) in filtro" v-bind:key="index">
                                    <input class="form-check-input" :name="x.ano+'_'" :checked="x.show" type="checkbox" @click="x.show = !x.show"/>
                                    <label>{{x.ano}}</label>
                                </div>
                            </div>

                            <div v-if="showMenu == '2'" class="col-5">
                                <h5>Seleccionar meses</h5>
                                <div class="form-check form-check-inline" v-for="(m, x) in Meses" v-bind:key="x">
                                    <input class="form-check-input" :name="m.mes+'_'" :checked="m.show" type="checkbox" @click="m.show = !m.show"/>
                                    <label>{{m.mes}}</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <small class="btn btn-primary" @click="getFiltro()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
                                        <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                                    </svg>
                                    FILTRAR
                                </small>
                            </div>    
                        </div>
                        <!-- <div class="bd-highlight">
                            <span class="btn btn-danger" @click="filtroShow = false">X</span>
                        </div> -->
                    </div>
                </div>
            </div>
            <div :class="showMenu == '3'? 'row ms-0 me-0 my-0 py-0':'d-none'">
                <div class="col-4 px-0 mx-0 ms-0 pe-3">
                    <div class="widget widget-table-two">
                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="bg-dark">
                                            <td class="text-center medio">    
                                                <small class="">AREA</small>
                                            </td>
                                            <td class="text-center medio">
                                                <small class="">DIAS</small>
                                            </td>
                                            <td>
                                                <small class="">EVENTOS</small>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white" v-for="(dato, i) in datosProcesos" :key="i">
                                            <td class="truncar" ><small>{{ dato.proceso }}</small></td>
                                            <td style="width:10%">{{ dato.Dias }}</td>
                                            <td>{{ dato.Eventos }}</td> 
                                        </tr>                                 
                                    </tbody>
                                </table>
                            </div>
                        </div>    
                    </div>
                </div>

                <div class="card widget col-8 ms-0 pt-3 mb-3">
                    <h6 class="py-3 text-center">AREAS POR AÑO </h6>
                    <amchart-apilado-more
                        etiquetas
                        paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                        unidad="270"
                        desapilar
                        tooltip
                        grilla="0"
                        redondear
                        orientacion="vertical"
                        leyenda="top"
                        cursor
                        ref="procesos">
                    </amchart-apilado-more>
                </div>         
                
            </div>              
            <!-- opcion de mes-->
            <div v-if="showMenu == '2'" :class="showMenu == '2'? 'row ms-0 me-0 my-0 py-0':'d-none'"> 
                <div class="col-12 card widget mx-0 my-0 mb-3 px-0 py-0">
                    <h6 class="py-3 text-center"> 
                        COMPARATIVO ENTRE MESES SEGUN AÑO. {{ AnosActivos }}
                    </h6>
                    <amchart-linea
                        manual
                        paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                        grosor="3"
                        etiquetas
                        grilla="0"
                        cursor
                        tooltip
                        preloading
                        altura="400" 
                        ref="meses"
                        leyenda="bottom"
                        campo_categoria="mes"
                        ></amchart-linea>
                </div>       
                <div class="col-6 mx-0 my-0 px-0 py-0 mb-3">
                    <div class="card widget mx-0 my-0 px-3 py-3 me-2">
                        <h6 class="py-3 text-center">DIAS</h6>
                        <amchart-apilado-more
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            multicolor
                            desapilar
                            orientacion="vertical"
                            unidad="200"
                            leyenda="top"
                            cursor
                            grilla="0"
                            ref="meses_vs_dias"></amchart-apilado-more>
                    </div>
                </div>
                <div class="col-6 mx-0 my-0 px-0 py-0 mb-3">
                    <div class="card widget mx-0 my-0 px-3 py-3 ms-2">
                        <h6 class="py-3 text-center">EVENTOS</h6>
                        <amchart-apilado-more  
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            desapilar
                            unidad="200"
                            leyenda="top"
                            orientacion="vertical"
                            grilla="0"
                            cursor
                            ref="meses_vs_eventos"></amchart-apilado-more>    
                    </div>
                </div> 
                <div class="col-12  mx-0 my-0 py-0 px-0 mb-3 ">
                    <div class="card widget px-3 py-3">
                        <h6 class="py-3 text-center">INCAPACIDADES NUEVAS</h6>
                        <amchart-apilado-more        
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            etiquetas
                            desapilar
                            unidad="250"
                            leyenda="top"
                            orientacion="vertical"
                            grilla="0"
                            cursor
                            ref="incapacidades_nuevas"></amchart-apilado-more> 

                    </div>
                </div>
                <div class="col-12 mx-0 my-0 py-0 px-0">
                    <div class="card widget px-3 py-3">
                        <h6 class="py-3 text-center">INCAPACIDADES PRORROGAS</h6>
                        <amchart-apilado-more        
                            paleta="2"
                            etiquetas
                            multicolor
                            desapilar
                            unidad="100"
                            leyenda="bottom"
                            orientacion="horizontal"
                            grilla="0"
                            cursor
                            ref="incapacidades_prorrogas"></amchart-apilado-more> 

                    </div>
                </div>      
            </div>

            <div :class="showMenu == '1'? 'row ms-0 me-0 my-0 py-0 mt-1':'d-none'">
                <div class="col-6 my-0 py-0 py-0 px-0">
                    <div class="card widget py-3 px-1">
                        <h6 class="py-3 text-center">AUSENTISMO AÑOS (VS) DIAS</h6>
                        <amchart-barra
                            etiquetas
                            multicolor
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            altura="250" 
                            redondeado
                            cursor
                            tooltip
                            sin_valores
                            ref="anos_vs_dias"
                            campo_categoria="ano"
                            campo_valor="Dias"></amchart-barra>    
                    </div>
                </div>
                <div class="col-6 ms-0 py-0 px-0 ps-3">
                    <div class="card widget py-3 px-1">
                        <h6 class="py-3 text-center"> AUSENTISMO AÑOS (VS) EVENTOS</h6>
                        <amchart-barra
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            multicolor
                            altura="250" 
                            redondeado
                            tooltip
                            cursor
                            sin_valores
                            ref="anos_vs_eventos"
                            campo_categoria="ano"
                            campo_valor="Eventos"></amchart-barra> 
                    </div>   
                </div>
                <div class="col-12 ms-0 py-0 px-0 pt-3">
                    <div class="card widget py-3 px-3">
                        <h6 class="py-3 text-center">AUSENTISMO ( DIAS - EVENTOS )  VS AÑOS</h6>
                        <amchart-linea
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            efecto
                            radio="40"
                            grosor="2"
                            cursor
                            puntos
                            tooltip
                            preloading
                            altura="300" 
                            ref="anos_vs_all"
                            leyenda
                            campo_categoria="ano"
                            campo_valor="Dias,Eventos"></amchart-linea>
                    </div>
                </div>
                
                <div class="col-12 ms-0 py-0 px-0 pt-3">
                    <div class="card widget py-3 px-3">
                        <h6 class="py-3 text-center">CONTINGENCIAS ( DIAS )  VS AÑOS <small class="d-none" @click="descargar('anos_vs_tipo_contingencia_dias')">View</small></h6>
                        <amchart-apilado-more
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc" 
                            redondear
                            cursor
                            tooltip
                            desapilar
                            orientacion="hotizontal"
                            altura="350" 
                            leyenda="top"
                            sin_valores
                            ref="anos_vs_tipo_contingencia_dias"></amchart-apilado-more>

                            
                    </div>
                </div>
                <div class="col-4 ms-0 py-0 px-0 pt-3">
                    <div class="card widget py-3 px-3 me-3">
                        <h6 class="py-3 text-center"> ENFERMEDAD LABORAL (EL)</h6>
                        <amchart-barra
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            altura="250" 
                            cursor
                            tooltip
                            sin_valores
                            ref="anos_vs_el"
                            campo_categoria="ano"
                            campo_valor="Eventos,Dias"></amchart-barra>
                    </div>
                </div>
                <div class="col-4 ms-0 py-0 px-0 pt-3">
                    <div class="card widget py-3 px-3 me-3">
                        <h6 class="py-3 text-center"> ACCIDENTE LABORAL (AL)</h6>
                        <amchart-barra
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            altura="250" 
                            cursor
                            tooltip
                            sin_valores
                            ref="anos_vs_al"
                            campo_categoria="ano"
                            campo_valor="Eventos,Dias"></amchart-barra>
                    </div>
                </div>
                <div class="col-4 ms-0 py-0 px-0 pt-3">
                    <div class="card widget py-3 px-3">
                        <h6 class="py-3 text-center"> ENFERMEDAD COMUN (EF)</h6>
                        <amchart-barra
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            altura="250" 
                            cursor
                            tooltip
                            sin_valores
                            ref="anos_vs_ec"
                            campo_categoria="ano"
                            campo_valor="Eventos,Dias"></amchart-barra>
                    </div>
                </div>
                <div class="col-4 ms-0 py-0 px-0 pt-3">
                    <div class="card widget py-3 px-3 me-3">
                        <h6 class="py-3 text-center"> LICENCIA DE MATERNIDAD (LM)</h6>
                        <amchart-barra
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            altura="250" 
                            cursor
                            tooltip
                            sin_valores
                            ref="anos_vs_lm"
                            campo_categoria="ano"
                            campo_valor="Eventos,Dias"></amchart-barra>
                    </div>
                </div>
                <div class="col-4 ms-0 py-0 px-0 pt-3">
                    <div class="card widget py-3 px-3 me-3">
                        <h6 class="py-3 text-center"> LICENCIA DE PATERNIDAD (LP)</h6>
                        <amchart-barra
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            altura="250" 
                            cursor
                            tooltip
                            sin_valores
                            ref="anos_vs_lp"
                            campo_categoria="ano"
                            campo_valor="Eventos,Dias"></amchart-barra>
                    </div>
                </div>
                <div class="col-4 ms-0 py-0 px-0 pt-3">
                    <div class="card widget py-3 px-3">
                        <h6 class="py-3 text-center"> ACCIDENTE DE TRANSITO (AT)</h6>
                        <amchart-barra
                            etiquetas
                            paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                            altura="250" 
                            cursor
                            tooltip
                            sin_valores
                            ref="anos_vs_at"
                            campo_categoria="ano"
                            campo_valor="Eventos,Dias"></amchart-barra>
                    </div>
                </div>
            </div>
        </div>  
       
    </div>
</template>

<script>
export default {
    props:{
        path:{type: String, default:''}
    },

    data() {
        return {
            Cliente :JSON.parse(document.querySelector('meta[name="user"]').getAttribute('content')),
            myModal : null, 
            campos :{},
            ano : null,
            mes : null,
            anosDatos : '',
            mesDatos : '',
            filtro: [],
            Meses: [
                {'mes':'Enero', 'show':true},
                {'mes':'Febrero', 'show':true},
                {'mes':'Marzo', 'show':true},
                {'mes':'Abril', 'show':true},
                {'mes':'Mayo', 'show':true},
                {'mes':'Junio', 'show':true},
                {'mes':'Julio', 'show':true},
                {'mes':'Agosto', 'show':true},
                {'mes':'Septiembre', 'show':true},
                {'mes':'Octubre', 'show':true},
                {'mes':'Noviembre', 'show':true},
                {'mes':'Diciembre', 'show':true}
            ],
            menu : [
                {'id':'1','opcion':'Incapacidades por Año','show':true},
                {'id':'2','opcion':'Incapacidades por Mes','show':true}, 
                {'id':'3','opcion':'Incapacidades por Area','show':true} 
            ],
            showMenu:'1',
            status: 'ini',
            state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'},
            filtroShow : false,
            datosProcesos: [],
            dataMeses :[], 
            AnosActivos : "", //años para pasar al componete linea campo_categoria
            MesActivos : [] //mes para saber los activos
        }
    },
    methods: { 
        descargar: function(arg){
            this.$refs[arg].exportar();
           
        },
        getFiltro: function(){
            let tm = '';
            let tmMes = '';
            

            this.filtro.forEach(elm => {
                if(elm.show){
                    tm += elm.ano + ",";
                }
                this.AnosActivos = tm.substring(0,tm.length -1);
            });

            this.MesActivos = [];
            this.Meses.forEach(elm => {
                if(elm.show){
                    tmMes += elm.mes + ",";
                    this.MesActivos.push({'mes':elm.mes});
                }
                
            });

            this.mesDatos = tmMes.substring(0,tmMes.length -1);
            this.anosDatos = tm.substring(0,tm.length-1);
            switch(this.showMenu){
                case '1': this.panel1(); break;
                case '2': this.panel2(); break;
                case '3': this.panel3(); break;
            }   
        },

        isEmpty: function(arg){
            return ['', undefined, null].includes(arg);
        },

        getVariable: function(arg){
            return this.graficoActual != null ? this.graficoActual[arg]:'';
        },

        selectOpcion: function(arg){
            this.showMenu = arg.id;
            switch(this.showMenu){
                case '1': this.panel1(); break;
                case '2': this.panel2(); break;
                case '3': this.panel3(); break;
            }
        },
        panel1: function(){
            this.load_comparacionXAno_grf();
            this.load_comparacionXAno_tipo_contingencia_grf();
        },
        panel2: function(){
            this.load_comparacionXMes_grf();
        },
        panel3: function(){
            this.load_comparacionXProcesos_grf();
        },

        getAnos: function(){
            this.status = this.state.LOADING;
            let pam = {'cliente_id':this.Cliente.cliente_id};
            //alert(this.Cliente.cliente_id)
            axios.post(this.path+'/getAnos', pam).then(res => {
                res.data.forEach(elm => {
                    this.filtro.push({'ano':elm.ano, 'show' : true}); 
                });  
                console.log('aqui');
                console.log(this.filtro);
                this.status = this.state.LOADED;
                this.getFiltro();
               // this.panel1();
            }).catch(err => {
                this.status = this.state.FAILED;
                console.log(err);
            });
        },

        load_comparacionXAno_grf: function(){
            this.status = this.state.LOADING;
            let pam = {};
            this.anosDatos.length > 0 ? pam = {'cliente_id':this.Cliente.cliente_id,'ano': this.anosDatos}: pam = {'cliente_id':this.Cliente.cliente_id};
            axios.post(this.path+'/comparacionXAno_grf', pam).then(res => {
                res.data.map(elm => {
                    elm.ano = elm.ano.toString();
                })
                this.$refs['anos_vs_dias'].setDatos(res.data);
                this.$refs['anos_vs_eventos'].setDatos(res.data); 
                this.$refs['anos_vs_all'].setDatos(res.data); 
                this.status = this.state.LOADED;
            }).catch(err => {
                this.status = this.state.FAILED;
                console.log(err);
            });
        },

        load_comparacionXAno_tipo_contingencia_grf:function(){
            this.status = this.state.LOADING;
            let pam = {};
            this.anosDatos.length > 0 ? pam = {'cliente_id':this.Cliente.cliente_id,'ano': this.anosDatos}: pam = {'cliente_id':this.Cliente.cliente_id};
            axios.post(this.path+'/comparacionXAno_tipo_contingencia_grf', pam).then(res => {
                // let tp = '';
                res.data.map(elm =>{  
                    
                    elm.ano = elm.ano.toString();
                    
                    return elm;     
                })
                this.$refs['anos_vs_el'].setDatos(res.data.filter(elm => elm.tipo_contingencia == 'EL'));
                this.$refs['anos_vs_al'].setDatos(res.data.filter(elm => elm.tipo_contingencia == 'AL'));
                this.$refs['anos_vs_ec'].setDatos(res.data.filter(elm => elm.tipo_contingencia == 'EC'));
                this.$refs['anos_vs_lm'].setDatos(res.data.filter(elm => elm.tipo_contingencia == 'LM'));
                this.$refs['anos_vs_lp'].setDatos(res.data.filter(elm => elm.tipo_contingencia == 'LP'));
                this.$refs['anos_vs_at'].setDatos(res.data.filter(elm => elm.tipo_contingencia == 'AT'));
                //this.$refs['anos_vs_tipo_contingencia'].setDatos(res.data); 
                this.$refs['anos_vs_tipo_contingencia_dias'].setDatosGroup(res.data, 'ano', 'tipo_contingencia', 'Dias');
                //this.$refs['anos_vs_tipo_contingencia_eventos'].setDatosGroup(res.data, 'ano', 'tipo_contingencia', 'Dias');            
                
                this.status = this.state.LOADED;
            }).catch(err => {
                this.status = this.state.FAILED;
                console.log(err);
            });
        },

        load_comparacionXMes_grf: function(){
            this.status = this.state.LOADING;
            let pam = {};
            this.dataMeses = [];
           // alert(this.anosDatos);
            this.anosDatos.length > 0 ? pam = {'cliente_id':this.Cliente.cliente_id,'ano': this.anosDatos, 'mes':this.mesDatos}: pam = {'cliente_id':this.Cliente.cliente_id};
            axios.post(this.path+'/comparacionXMes_grf', pam).then(res => {
                this.$refs['meses_vs_dias'].setDatosGroup(res.data, 'mes', 'ano', 'dias');
                this.$refs['meses_vs_eventos'].setDatosGroup(res.data, 'mes', 'ano', 'eventos');
                //filtro son los años.... show=true los activos
                this.AnosActivos = "";
                this.filtro.forEach(an => {
                    if(an.show){
                        this.AnosActivos = this.AnosActivos + an.ano+','; 
                        res.data.forEach(elm => {
                            if(an.ano == elm.ano){
                                this.Meses.forEach(ms =>{
                                    if(ms.mes.toUpperCase() == elm.mes.toUpperCase()){
                                        this.dataMeses.push({'mes': ms.mes, [an.ano] : parseInt(elm.dias)})
                                    }
                                });
                             }
                        });
                    }
                });
                
                this.AnosActivos = this.AnosActivos.substring(0,this.AnosActivos.length-1).toString();
                this.AnosActivos = this.AnosActivos.trim();
                console.log('ano activo')
                console.log(this.AnosActivos);
               
                this.$refs['meses'].setDatos(this.grafMeses(this.dataMeses),'',this.AnosActivos);
                this.$refs['incapacidades_nuevas'].setDatosGroup(res.data, 'mes', 'ano', 'prorroga_n');
                this.$refs['incapacidades_prorrogas'].setDatosGroup(res.data, 'mes', 'ano', 'prorroga_s');
               
                this.status = this.state.LOADED;
            }).catch(err => {
                this.status = this.state.FAILED;
                console.log(err);
            });
        },

        grafMeses: function(arg){
            let data = [];
            let clave = '';
            let x = [];   
            for(let j = 0; j < this.filtro.length; j++){
                if(this.filtro[j].show == true){
                    for(let i = 0; i < this.MesActivos.length; i++){    
                        data.push({'mes':this.MesActivos[i].mes, [this.filtro[j].ano]:0});
                    }
                }
            }
            arg.forEach(elm =>{
                clave = Object.keys(elm).toString().split(',')[0];
                //alert(elm.mes+' -- '+clave[0]+':'+elm[clave[0]]);
                data.map(mp =>{
                    if(clave == Object.keys(mp).toString().split(',')[0]){
                       if(elm.mes == mp.mes){
                         mp[clave] = elm[clave];
                       }
                    }
                })
            })
            console.log('Data Mes graf')
            console.log(data);
            return data;
        },

        load_comparacionXProcesos_grf: function(){
            this.status = this.state.LOADING;
            let pam = {};
            this.anosDatos.length > 0 ? pam = {'cliente_id':this.Cliente.cliente_id,'ano': this.anosDatos, 'mes':this.mesDatos} : pam = {'cliente_id':this.Cliente.cliente_id};
            axios.post(this.path+'/comparacionXProcesos_grf', pam).then(res => {
                let poc = 1;
                res.data.map(elm => {
                    elm.Dias = parseInt(elm.Dias);
                    elm.Eventos =parseInt(elm.Eventos);
                });
                this.datosProcesos = res.data;
                this.$refs['procesos'].setDatosGroup(this.datosProcesos, 'proceso', 'ano', 'Dias');
                
                // this.$forceUpdate();
                // console.log('Ref:');
                // console.log(this.$refs['gp_2021']);
                this.$refs['gp_2021'].setDatosX(res.data.filter(elm => elm.ano == '2021'));
                this.$refs['gp_2022'].setDatos(res.data.filter(elm => elm.ano == '2022'));
                // if(this.$refs['gp_2021'] != undefined){
                // }
                //buscamos los años del fitro - show activo
                // this.filtro.forEach(ftr => {
                //     let datoX = [];
                //     if(ftr.show){
                //         datoX = res.data.filter(elm => elm.ano == ftr.ano)  
                //     }
                //     this.datosProcesos.push({'ano':ftr.ano, 'data':datoX});
                //     //this.$refs[datoX.ano].setDatos(datoX);
                // });

                // let xDts = $refs['procesos'].getDatos();
                // this.$refs['2021'].setDatos(xDts);
                
               /*
                this.datosProcesos.forEach(element => {
                    let ano = element.ano;
                    this.$refs.ano.setDatos(element.data);
                })
                */
                //this.$refs['proceso21'].setDatos(Object.values(this.datosProcesos[0]));
                
               // console.log(this.datosProcesos[0]);         
                this.status = this.state.LOADED;
            }).catch(err => {
                this.status = this.state.FAILED;
                console.log(err);
            });

        },

        listen: function(){
            this.$eventBus.$on('evt_gp1', arg => {
                this.panelSuperior = false;
                this.verAusentista(arg);
            });

            this.$eventBus.$on('close-ventana', arg => {
                this.panelSuperior = arg.close;
            });
        },
        dispatchOID: function(oid){
            this.$eventBus.$emit('show-ausentista', {'id': oid});
        }
        
    },

    mounted(){
      this.getAnos();
    }
}
</script>
<style scoped>
    .colmin {width: 1%; white-space: nowrap; text-align: center; padding: 0 0 0 0;}
    .loading {opacity: .45; pointer-events: none; user-select: none; padding: 0; margin: 0;}
    .truncar {white-space: normal !important; margin-top: 0; margin-bottom: 0;}
    .fmenu{background-color: #e0e6ed; border: solid 1px #d3d3d3; font-size: small;}
    .cursor{cursor:pointer;}
    .medio{width: 50%;}
</style>
