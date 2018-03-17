<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>Import Test</title>
    <link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <style type="text/css">
       h1{
        font-family: Helveticaneue;
        font-size: 40px;
        text-align: center;
        padding-bottom: 10px;
        position: relative;
        color: black;
       }

       select{
        width: 300px;
       }

       .file{
        position: relative;
        left: 100px;
        padding-top: 20px;
       }

       input[type=submit]{
        width: 350px;
        position: relative;
        left: 360px;
       }

       .heh{
        font-family: Montserrat;
        border: 2px solid #b9382e;
       }

       .green{
        border: 2px solid #5eaa4d;
       }

       [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>
    <div id="root" v-cloak>
        <loading-modal v-if="loading" content="Adding Students..."> </loading-modal>
        <dashboard :link="'/import'" admin={{$admin}}> 
            <div class="box">
                <form method="POST" action="/import" enctype="multipart/form-data" @submit.prevent="submit">
                    <h1>IMPORT STUDENTS</h1>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Course + Level: </label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control is-expanded">
                                    <div class="select">
                                        <select name="course" v-model="course">
                                            <option disabled value="">Select Course</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course}}">{{$course}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control is-expanded">
                                    <div class="select">
                                        <select name="level" v-model="level">
                                            <option disabled value="">Select Level</option>
                                            @foreach($levels as $level)
                                                <option value="{{$level}}"> {{$level}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Hall: </label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control is-expanded">
                                    <div class="select">
                                        <select name="hall" v-model="hall">
                                            <option value="" disabled="">Select Hall</option>
                                            @foreach($halls as $hall)
                                                <option value="{{$hall}}">{{$hall}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <div class="file is-dark has-name" :class="{ 'has-name' : file}">
                            <label class="file-label">
                               <input type="file" name="file" class="file-input" @change="processFile($event)">
                               <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fa fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Upload Excel File..
                                    </span>
                               </span>
                               <span class="file-name" v-if="file">
                                   @{{file.name}}
                               </span>
                            </label>
                        </div>
                    </div>
                
                    <div class="field">
                        <div class="control">
                          <input type="submit" name="Submit" value="Submit" class="button is-dark is-medium">  
                        </div>
                    </div>
                </form>
                <modal v-if="showModal && errors.message" @close="showModal = false; errors={} " :green="false">
                    @{{errors.message}}
                </modal>

                <modal v-if="showModal && success" @close="showModal = false; success='' " :green="true">
                    @{{success}}
                </modal>
            </div>

        </dashboard>

            
    </div>

</body>
</html>

<script type="text/javascript" src="js/app.js"></script>