<template>

    <div :class="status">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="input-group border-0 mb-4" style="cursor: pointer;">
                <div :class="showMenu == gr.id? 'form-control text-center btn btn-dark':'form-control text-center btn btn-gray'" @click="selectOpcion(gr)" v-for="(gr,i) in menu" :key="i">
                    <button  class="btn bg-white btn-icon mb-0  btn-rounded">
                        <i v-if="showMenu == gr.id" class="fa-regular fa-folder-open h5 py-0 px-0 mx-0 my-0"></i>
                        <i v-else class="fa-solid fa-folder h5 py-0 px-0 mx-0 my-0"></i>
                    </button>
                    {{ gr.opcion }}
                </div>
            </div>
            <div :class="showMenu == '1'? 'px-0 py-0':'d-none' ">
                <div class="widget widget-card-five">
                    <div class="widget-content">
                        <div class="account-box">
                            <div class="info-box">
                                <div class="icon">
                                    <span>
                                        <img :src="path+'/img/money-bag.png'" alt="money-bag">
                                    </span>
                                </div>

                                <div class="balance-info">
                                    <h6>SALDO ACTUAL</h6>
                                    <p> $ {{parseFloat(sumaIn-sumaOut).toLocaleString('es') }}</p>
                                </div>
                            </div>

                            <div class="card-bottom-section">
                                <div><span class="badge badge-light-success">+ 13.6% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg></span></div>
                                <a href="javascript:void(0);" class="">View Report</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card px-3 my-3">
                    <div class="card-body text-center">
                        <h6 class="mb-0 ih-title">INGRESO POR CAJAS</h6>
                    </div>
                    <amchart-torta
                        etiquetas
                        paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                        leyenda="top"
                        cursor
                        radio="70"
                        altura="250"
                        ref="saldo_in"
                        campo_categoria="caja"
                        campo_valor="movimiento"></amchart-torta>
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <h6 class="mb-0 ih-title">SALIDAS POR CAJAS</h6>
                    </div>
                    <amchart-torta
                        etiquetas
                        paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                        leyenda="top"
                        cursor
                        radio="70"
                        altura="250"
                        ref="saldo_out"
                        campo_categoria="caja"
                        campo_valor="movimiento"></amchart-torta>
                </div>
                <div class="card my-3 py-3">
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
                        ref="movimientos"
                        leyenda
                        campo_categoria="fecha"
                        campo_valor="movimiento"></amchart-linea>
                </div>
                <div class="card my-3 py-3">
                    <amchart-barra
                    etiquetas
                        multicolor
                        paleta="#1cdddc,#a5d8eb,#fa9f9e,#b4c1c7,#ffded9,#b0f0a4,#aef0ff,#ffa9de,#a1b4ff,#ffcf9e,#febdd1,#72cccc"
                        altura="250"
                        redondeado
                        cursor
                        tooltip
                        sin_valores
                        ref="caja"
                        campo_categoria="caja"
                        campo_valor="movimiento"></amchart-barra>
                </div>

            </div>
            <div :class="showMenu == '2'? 'px-0 py-0':'d-none' ">
               <h4>
                   MOVIMIENTOS
               </h4>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr v-for="(dt, dto) in movimientosAll" :key="dto" @click="view_movimiento(dt)">
                                <td class="fs-6">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> -->
                                    {{dt.fecha}}
                                    <br>{{ dt.detalle }}
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center fs-5">
                                    <span :class="dt.tipo == 'in'? 'text-success':'text-danger'">$ {{ parseFloat(dt.movimiento).toLocaleString('es')}}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div :class="showMenu == '3'? 'px-0 py-3':'d-none' ">
                <!-- inicio -->
                <div class="row">
                    <div class="col-12">
                        <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" @click="movimientoOpcion='in'" name="btnradio" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btnradio1">INGRESO</label>

                            <input type="radio" class="btn-check" @click="movimientoOpcion='out'" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-danger" for="btnradio2">SALIDA</label>
                        </div>
                    </div>
                </div>
                <div :class="movimientoOpcion == 'in' ? 'card p-3 bg-light-success border border-light-success':'d-none'">
                    <form>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-12 col-form-label">DINERO A INGRESAR</label>
                            <div class="col-sm-12">
                            <input type="number" v-model="movimiento" required class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-12 col-form-label">DETALLE DE INGRESO</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" v-model="detalle" name="" id=""></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-form-label col-sm-12 pt-0">DONDE INGRESA EL DINERO <span @click="loadCaja()">[Add]</span></label>
                                <select class="form-control" v-model="id_caja">
                                    <option v-for="(cl , i) in cajas" :key="i" :value="cl.id">
                                        {{ cl.caja }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 pt-3">
                                <label class="col-form-label col-sm-12 pt-0">GENERADOR DEL DINERO <span @click="loadOpcion('in')">[Add]</span></label>
                                <select class="form-control" v-model="id_opcion">
                                    <option disabled value="">Seleccionar</option>
                                    <option :value="opc.id" v-for="(opc , i) in opcionIN" :key="i">
                                        {{ opc.opcion }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div @click="registro_movimiento" class="btn btn-primary w-100 py-3 mt-3" >REGISTRAR INGRESO</div>
                    </form>
                </div>

                <div :class="movimientoOpcion == 'out' ? 'card bg-light-danger border border-light-danger p-3':'d-none'">
                    <form>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-12 col-form-label">SALIDA DE DINERO</label>
                            <div class="col-sm-12">
                            <input type="number" v-model="movimiento" required class="form-control" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-12 col-form-label">DETALLE DE SALIDA</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" v-model="detalle" name="" id=""></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="col-form-label col-sm-12 pt-0">DONDE SALE EL DINERO <span @click="loadCaja()">[Add]</span></label>
                                <select class="form-control" v-model="id_caja">
                                    <option v-for="(cl , i) in cajas" :key="i" :value="cl.id">
                                        {{ cl.caja }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 py-3">
                                <label class="col-form-label col-sm-12 pt-0">GENERADOR DE LA SALIDA <span @click="loadOpcion('out')">[Add]</span></label>
                                <select class="form-control" v-model="id_opcion">
                                    <option disabled value="">Seleccionar</option>
                                    <option :value="opc.id" v-for="(opc , i) in opcionOUT" :key="i">
                                        {{ opc.opcion }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div @click="registro_movimiento" class="btn btn-danger py-3 w-100" >REGISTRAR SALIDA </div>
                    </form>
                </div>
                <!-- fin -->
            </div>
        </div>
         <!-- modal movimiento-->
          
         <div class="modal dialog-centered" id="ModalMovimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content fondo">
                    <div class="modal-body">
                        <div class="card style-5  mb-md-0 mb-4">
                            <div class="card-content">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">Movimiento</h5>
                                    <p class="card-text fs-5">
                                        Tipo : {{ this.change_tipo_movimiento(this.movimientoX.tipo)}}
                                    </p>
                                    <p class="card-text fs-5">
                                        Valor:
                                        {{ this.movimientoX.movimiento }}
                                    </p>
                                    <p class="card-text fs-5">
                                        Detalle : <br>
                                        {{ this.movimientoX.detalle }}
                                    </p>
                                    <p class="card-text fs-5">
                                        Caja: 
                                        {{ this.movimientoX.caja }}
                                    </p>
                                    <p class="card-text fs-5">
                                        Opcion: 
                                        {{ this.movimientoX.opcion }}
                                    </p>
                                    <p class="card-text fs-5">
                                        Fecha:
                                        {{ this.movimientoX.fecha }}
                                    </p>
                                    <p class="card-text fs-5">
                                        Hora: 
                                        {{ this.movimientoX.hora }}
                                    </p>                       
                                </div>
                                <div class="card-body">
                                    <div class="btn btn-danger" @click="eliminar_movimiento()">
                                        Eliminar este Movimento
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Fin modal Movimiento -->

        <!-- modal caja-->
        <div class="modal fade zoom-in-up" id="ModalCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content fondo">
                    <div class="modal-body">
                        <form>
                            <label for="form-control">Nuevo banco o Caja</label>
                            <input type="text" class="form-control" v-model="CajaNew">
                            <div class="btn btn-primaryu" @click="agregar_caja()">Add</div>
                        </form>
                        <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Caja o Banco</th>
                                        <th>Opc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(cj ,c) in cajas" :key="c">
                                        <td>{{ c+1 }}</td>
                                        <td>{{ cj.caja }}</td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" @click="delete_caja(cj.caja,cj.id)">
                                                <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                            </svg>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Fin modal caja -->
         <!-- modal opcion-->
        <div class="modal fade zoom-in-up" id="ModalOpcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content fondo">
                    <div class="modal-body">
                        <form>
                            <label for="form-control"> REGISTRAR OPCION DE INGRESO</label>
                            <input type="text" class="form-control" v-model="OpcionNew">
                            <div class="btn btn-primaryu" @click="agregar_opcion()">Add</div>
                        </form>
                        <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th v-if="opcionActive == 'in'">Opcion de Ingreso </th>
                                        <th v-else>Opcion de Egreso </th>
                                        <th>Opc</th>
                                    </tr>
                                </thead>
                                <tbody v-if="opcionActive == 'in'">
                                    <tr v-for="(opc , t) in opcionIN" :key="t">
                                        <td>{{ t+1 }}</td>
                                        <td>{{ opc.opcion }}</td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" @click="delete_opcion(opc.opcion,opc.id)">
                                                <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                            </svg>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr v-for="(opcc , tt) in opcionOUT" :key="tt">
                                        <td>{{ tt+1 }}</td>
                                        <td>{{ opcc.opcion }}</td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" @click="delete_opcion(opcc.opcion,opcc.id)">
                                                <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                            </svg>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Fin modal opcion-->
    </div>


  </template>

  <script>
    import axios from 'axios';
    //import PieChart from './../amcharts/pie.vue';
    export default {
        props:{
            path:{type:String, default:''},
            id : {type:String, default:'0'}
        },

        data() {
            return {
                status: 'ini',
                state: {'INI': 'ini', 'LOADING': 'loading', 'LOADED': 'loaded', 'FAILED': 'failed'},
                cajas:[],
                opcionIN:[],
                opcionOUT:[],
                movimiento:0,
                detalle: '',
                id_caja: 0,
                id_opcion:0,
                response:[],
                movimientoOpcion: 'in',
                menu : [
                    {'id':'1','opcion':'BALANCE','show':true},
                    {'id':'2','opcion':'MOVIMIENTOS','show':false},
                    {'id':'3','opcion':'REGISTRAR','show':false},
                ],
                showMenu: 1,
                movimientosAll:[],
                movimientoMatrix:[],
                sumaIn:0,
                sumaOut:0,
                saldoCajas:[],
                CajaNew:'',
                OpcionNew:'',
                opcionActive:'',
                movimientoX:[],
            }
        },
        methods:{
            change_tipo_movimiento: function(arg){
                let x = arg;
                switch(arg){
                    case 'in': x = 'INGRESO'; break;
                    case 'out': x = 'EGRESO'; break;
                }
                return x;
            },
            selectOpcion: function(arg){
                this.showMenu = arg.id;
            },
            setOpcion: function(arg){
                this.opcion = arg
            },
            setCaja: function(arg){
                this.id_caja = arg;
                alert(arg)
            },
            agregar_caja: function(){
                this.status = this.state.LOADING;
                if(this.CajaNew.length > 3){
                    let fields =  new FormData();
                    fields.append('caja',this.CajaNew);
                    axios.post(this.path+'/agregar_caja-vue',fields).then(res => {
                        if(res.data.state == 'ok'){
                            console.log('registro exitoso');
                            this.CajaNew = '';
                            this.cargar_cajas();
                        }
                        this.status = this.state.LOADED;
                    }).catch(err => {
                        console.log(err);
                        this.status = this.state.FAILED;
                    });
                }else{
                    alert('Debe digitar un nombre para la CAJA o BANCO')
                    this.status = this.state.LOADED;
                }
            },
            delete_caja: function(cj, id){
                Swal.fire({
                    title: "Desea eliminar el BANCO o CAJA "+cj+"?",
                    text: "Una vez eliminado, NO hay vuelta atras.!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, deseo eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.status = this.state.LOADING;
                        let fields =  new FormData();
                        fields.append('id',id);
                        axios.post(this.path+'/eliminar_caja-vue',fields).then(res => {
                            if(res.data.state == 'ok'){
                                console.log('Eliminacion exitosa');
                                this.cargar_cajas();
                            }
                            this.status = this.state.LOADED;
                        }).catch(err => {
                            console.log(err);
                            this.status = this.state.FAILED;
                        });


                        Swal.fire({
                            title: "Eliminado!",
                            text: "Tu opción "+cj+" ha sido eliminada.",
                            icon: "success"
                        });
                    }
                })

            },
            agregar_opcion: function(){
                this.status = this.state.LOADING;
                if(this.OpcionNew.length > 3){
                    let fields =  new FormData();
                    fields.append('opcion',this.OpcionNew);
                    fields.append('tipo',this.opcionActive);
                    //console.log(this.OpcionNew+' - '+tipo);
                    axios.post(this.path+'/agregar_opcion-vue',fields).then(res => {
                        if(res.data.state == 'ok'){
                            console.log('registro exitoso');
                            this.cargar_opcion();
                            this.OpcionNew = '';
                        }
                        this.status = this.state.LOADED;
                    }).catch(err => {
                        console.log(err);
                        this.status = this.state.FAILED;
                    });
                }else{
                    alert('Debe digitar un nombre para la OPCION')
                    this.status = this.state.LOADED;
                }
            },
            delete_opcion: function(cj, id){
                Swal.fire({
                    title: "Desea eliminar la opcion "+cj+"?",
                    text: "Una vez eliminada la OPCION, NO hay vuelta atras.!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, deseo eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.status = this.state.LOADING;
                        let fields =  new FormData();
                        fields.append('id',id);
                        axios.post(this.path+'/eliminar_opcion-vue',fields).then(res => {
                            if(res.data.state == 'ok'){
                                console.log('Eliminacion exitosa');
                                this.cargar_opcion();
                            }
                            this.status = this.state.LOADED;
                        }).catch(err => {
                            console.log(err);
                            this.status = this.state.FAILED;
                        });


                        Swal.fire({
                            title: "Eliminado!",
                            text: "Tu opción "+cj+" ha sido eliminada.",
                            icon: "success"
                        });
                    }
                });






                // if(confirm('Deseas eliminar la Opcion ('+cj+') ')){
                //     this.status = this.state.LOADING;
                //     let fields =  new FormData();
                //     fields.append('id',id);
                //     axios.post(this.path+'/eliminar_opcion-vue',fields).then(res => {
                //         if(res.data.state == 'ok'){
                //             console.log('Eliminacion exitosa');
                //             this.cargar_opcion();
                //         }
                //         this.status = this.state.LOADED;
                //     }).catch(err => {
                //         console.log(err);
                //         this.status = this.state.FAILED;
                //     });
                // }
            },
            eliminar_movimiento: function(){
                Swal.fire({
                    title: "Desea eliminar el movimiento "+this.movimientoX.detalle+" por valor de "+this.movimientoX.movimiento+"?",
                    text: "Una vez eliminado, NO hay vuelta atras.!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, deseo eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.status = this.state.LOADING;
                        let fields =  new FormData();
                        fields.append('id',this.movimientoX.id);
                        axios.post(this.path+'/eliminar_movimiento-vue',fields).then(res => {
                            if(res.data.state == 'ok'){
                                console.log('Eliminacion exitosa');
                                this.cargar_movimientos();
                                this.movimientoX = [];
                            }
                            this.status = this.state.LOADED;
                        }).catch(err => {
                            console.log(err);
                            this.status = this.state.FAILED;
                        });


                        Swal.fire({
                            title: "Eliminado!",
                            text: "Tu opción "+cj+" ha sido eliminada.",
                            icon: "success"
                        });
                    }
                })
            },
            cargar_cajas: function(){
                this.status = this.state.LOADING;
                axios.post(this.path+'/cajas-vue').then(res => {
                    this.cajas = res.data;
                    this.status = this.state.LOADED;
                    console.log(this.cajas);
                }).catch(err => {
                    console.log(err);
                    this.status = this.state.FAILED;
                });
            },
            cargar_opcion: function(){
                this.status = this.state.LOADING;
                axios.post(this.path+'/opcion-vue').then(res => {
                    this.opcionIN = res.data.filter(elm => elm.tipo === 'in');
                    this.opcionOUT = res.data.filter(elm => elm.tipo === 'out');
                    console.log(this.opcionIN);
                    this.status = this.state.LOADED;
                }).catch(err => {
                    console.log(err);
                    this.status = this.state.FAILED;
                });
            },
            cargar_movimientos:function(){
                this.status = this.state.LOADING;
                axios.post(this.path+'/movimientos-vue').then(res => {
                    this.movimientosAll = res.data;
                    this.movimientoMatrix = res.data;
                    this.sumaIn = 0; this.sumaOut = 0;
                    this.movimientosAll.map(elm =>{
                        let tmp = elm.fecha.substr(5,2)
                        switch(elm.fecha.substr(5,2)){
                            case '01': tmp = 'Ene'; break;
                            case '02': tmp = 'Feb'; break;
                            case '03': tmp = 'Mar'; break;
                            case '04': tmp = 'Abr'; break;
                            case '05': tmp = 'May'; break;
                            case '06': tmp = 'Jun'; break;
                            case '07': tmp = 'Jul'; break;
                            case '08': tmp = 'Ago'; break;
                            case '09': tmp = 'Sep'; break;
                            case '10': tmp = 'Oct'; break;
                            case '11': tmp = 'Nov'; break;
                            case '12': tmp = 'Dic'; break;
                        }
                        elm.fecha = elm.fecha.substr(8,2)+' '+tmp+' '+elm.fecha.substr(0,4);
                        (elm.tipo == 'in')?this.sumaIn = this.sumaIn + elm.movimiento:this.sumaOut = this.sumaOut + elm.movimiento
                        return elm;
                    });
                    this.$refs['caja'].setDatos(res.data.filter(elm => elm.tipo == 'in'));
                    this.$refs['movimientos'].setDatos(res.data);
                    this.status = this.state.LOADED;
                    // console.log('datos-----ih');
                    // console.log(this.movimientosAll);
                    // console.log('fin');
                    // this.opcionIN = res.data.filter(elm => elm.tipo === 'in');
                    // this.opcionOUT = res.data.filter(elm => elm.tipo === 'out');
                    // console.log(this.opcionIN);
                }).catch(err => {
                   alert('isaias');
                    console.log(err);
                    this.status = this.state.FAILED;
                });
            },
            registro_movimiento : function(){
                if(this.status != this.state.LOADING){
                    this.status = this.state.LOADING;
                    let x = {
                        'movimiento':this.movimiento,
                        'detalle':this.detalle,
                        'tipo': this.movimientoOpcion,
                        'id_caja':this.id_caja,
                        'id_opcion': this.id_opcion
                    }
                    if((this.movimiento > 0)&&(this.detalle.length > 2)&&(this.id_caja != 0)&&(this.id_opcion != 0)){
                        let fields =  new FormData();
                        fields.append('movimiento',this.movimiento);
                        fields.append('detalle',this.detalle);
                        fields.append('tipo',this.movimientoOpcion);
                        fields.append('id_caja',this.id_caja);
                        fields.append('id_opcion',this.id_opcion);
                        // console.log(this.movimiento + ' '+this.detalle+ ' '+this.tipo+' '+this.id_caja+' '+this.id_opcion)
                        axios.post(this.path+'/registrarMovimiento-vue',fields).then(res => {
                            this.response = res.data;
                            this.status = this.state.LOADED;
                            if(this.response.state == 'ok'){
                                this.limpiar();
                                this.showMenu = 2;
                                this.cargar_movimientos();
                            }
                        }).catch(err => {
                            this.status = this.state.FAILED;
                            console.log(err)
                        })
                    }else{
                        alert('Los campos (son obligatorios)')
                    }
                }

            },
            view_movimiento: function(arg){
                this.movimientoX = arg;
                console.log(this.movimientoX);
                $('#ModalMovimiento').modal('show');
            },
            saldo_cajas: function(){
                if(this.status != this.state.LOADING){
                    this.status = this.state.LOADING;
                    axios.post(this.path+'/saldo_cajas-vue').then(res => {
                        this.saldoCajas = res.data;
                        console.log(this.saldoCajas);
                        this.$refs['saldo_in'].setDatos(res.data.filter(elm => elm.tipo == 'in'));
                        this.$refs['saldo_out'].setDatos(res.data.filter(elm => elm.tipo == 'out'));
                        this.status = this.state.LOADED;
                    }).catch(err => {
                        this.status = this.state.FAILED;
                        console.log(err)
                    })
                }
            },
            limpiar: function(){
                this.id_caja = 0;
                this.id_opcion = 0;
                this.movimiento = 0;
                this.detalle = '';
            },
            loadCaja: function(){
                $('#ModalCaja').modal('show');
            },
            loadOpcion: function(arg){
                this.opcionActive = arg;
                $('#ModalOpcion').modal('show');
            },
            getImg: function(arg){
                return this.path_img.replace('@',arg);
            },


        },
        mounted() {
            this.cargar_cajas();
            this.cargar_opcion();
            this.cargar_movimientos();
            this.saldo_cajas();
        }
    }
  </script>
  <style scoped>
    .colmin {width: 1%; white-space: nowrap; text-align: center}
    .loading {opacity: .45; pointer-events: none; user-select: none}
  </style>
