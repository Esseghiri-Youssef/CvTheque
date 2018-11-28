@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <div class="row">
     <div class="col-md-12">  
        <div class="panel panel-primary">
            <div class="panel-heading">
            <div class="row">
                     <div class="col-md-10"><h3 class="panel-title">Expériences</h3></div>
                     <div class="col-md-2">
                     <button class="btn btn-success  btn-xs pull-right" @click="open=true">Ajouter</button>
                     </div>
                 </div>
            </div>
            <div class="panel-body">
                <div v-if="open">
                    <div class="form-group">
                        <label for="">Titre</label>
                        <input type="text" value="" class="form-control" placeholder="le titre de l'experience" v-model="experience.titre">
                    </div>
                    <div class="form-group">
                        <label for="">Titre</label>
                        <textarea class="form-control" v-model="experience.body">l'experience</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date début</label>
                                <input type="date" value="" class="form-control" placeholder="Début" v-model="experience.debut">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date fin</label>
                                <input type="date" value="" class="form-control" placeholder="Fin" v-model="experience.fin">
                            </div>
                        </div>
                    </div>
                <button v-if="edit" class="btn btn-danger btn-block" @click="updateExperience">Modifier</button> 
                <button v-else class="btn btn-info btn-block" @click="addExperience">Ajouter</button>    
                </div>

                <ul class="list-group">
                    <li class="list-group-item" v-for="exp in experiences">
                    <div class="pull-right">
                    <button class="btn btn-danger btn-xs" @click="deleteExperience(exp)">Supprimer</button>
                    <button class="btn btn-warning btn-xs" @click="editExperience(exp)">Modifier</button>
                    </div>
                    <h3>@{{exp.titre}}</h3>
                    <p>@{{exp.body}}</p>
                    <small>@{{exp.debut}} - @{{exp.fin}}</small>
                    </li>
                </ul>
           </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                 <div class="row">
                     <div class="col-md-10"><h3 class="panel-title">Formations</h3></div>
                     <div class="col-md-2">
                     <button class="btn btn-success btn-xs pull-right">Ajouter</button>
                     </div>
                 </div>
            </div>
            <div class="panel-body">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique dignissimos facere culpa reprehenderit deserunt reiciendis quibusdam laudantium autem, rerum quae.
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
            <div class="row">
                     <div class="col-md-10"><h3 class="panel-title">Portfolio</h3></div>
                     <div class="col-md-2">
                     <button class="btn btn-success btn-xs pull-right">Ajouter</button>
                     </div>
                 </div>
            </div>
            <div class="panel-body">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique dignissimos facere culpa reprehenderit deserunt reiciendis quibusdam laudantium autem, rerum quae.
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
            <div class="row">
                     <div class="col-md-10"><h3 class="panel-title">Compétences</h3></div>
                     <div class="col-md-2">
                     <button class="btn btn-success btn-xs pull-right">Ajouter</button>
                     </div>
                 </div>
            </div>
            <div class="panel-body">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique dignissimos facere culpa reprehenderit deserunt reiciendis quibusdam laudantium autem, rerum quae.
            </div>
        </div>
    </div>
    </div>
</div>

@endsection

@section('javascript')



<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    window.Laravel={!!json_encode([
        'csrfToken'         => csrf_token(),
        'idCv'              =>$id,
        'url'               =>url('/')
    ])!!};
</script>

    <script>
   var app = new Vue ({
            el: "#app",
            data:{
                experiences:[],
                open:false,
                experience:{
                    id:0,
                    cv_id:window.Laravel.idCv,
                    titre:'',
                    body:'',
                    debut:'',
                    fin:''
                },
                edit:false
                 },
            methods:{
                getExperiences: function(){
                    axios.get(window.Laravel.url + '/getexperiences/'+ window.Laravel.idCv)
                        .then(response=>{
                           this.experiences = response.data    
                        })
                        .catch(error =>{
                            console.log('errors :', error)
                        })
                },
                addExperience: function(){
                    axios.post(window.Laravel.url + '/addexperience', this.experience)
                        .then(response=>{
                            if(response.data.etat){
                                this.open=false;
                                this.experience.id=response.data.id;
                                this.experiences.unshift(this.experience);
                                this.experience={
                                            id:0,
                                            cv_id:window.Laravel.idCv,
                                            titre:'',
                                            body:'',
                                            debut:'',
                                            fin:''
                                }
                            } 
                        })
                        .catch(error=>{
                            console.log('errors:', error)
                        })
                },
                editExperience:function(experience){
                    this.open=true;
                    this.edit=true;
                    this.experience=experience;
                },
                updateExperience:function(){
                    axios.put(window.Laravel.url + '/updateexperience', this.experience)
                        .then(response=>{
                            if(response.data.etat){
                                this.open=false;
                                this.experience={
                                            id:0,
                                            cv_id:window.Laravel.idCv,
                                            titre:'',
                                            body:'',
                                            debut:'',
                                            fin:''
                                },
                            this.edit=false; 
                            }
                        })
                        .catch(error=>{
                            console.log('errors:', error)
                        })
                },
                deleteExperience:function(experience){
                    axios.delete(window.Laravel.url + '/deleteexperience/' + experience.id)
                        .then(response=>{
                            if(response.data.etat){
                               var position = this.experiences.indexOf(experience);
                               this.experiences.splice(position,1);
                            }
                        })
                        .catch(error=>{
                            console.log('errors:', error)
                        })
                }
            },   
                mounted: function(){
                            this.getExperiences();
            }
        });
    </script>
@endsection