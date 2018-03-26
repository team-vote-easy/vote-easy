<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>Add Candidates</title>
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

       .input{
        width: 400px;
        box-shadow: none;
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
        width: 300px;
        position: relative;
        left: 440px;
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
        <loading-modal v-if="loading" content="Adding Candidate..."> </loading-modal>
        <dashboard :link="'/add-candidates'" admin={{$admin}}>
            <div class="box">
                <form method="POST" action="/import" enctype="multipart/form-data" class="" @submit.prevent="submit">
                    <h1>ADD CANDIDATES</h1>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Name: </label>
                        </div>
                        <div class="field-body">

                            <div class="field">
                                <div class="control is-expanded">
                                    <input type="text" name="first_name" class="input" placeholder="First Name" v-model="firstName">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control is-expanded">
                                    <input type="text" name="first_name" class="input" placeholder="Last Name" v-model="lastName">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label"> Position:</label>
                        </div>
                        <div class="field-body">
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="position" v-model="role" @change="handleChange">
                                            <option value="" disabled>Select Position</option>
                                            @foreach($positions as $position)
                                                <option value="{{$position}}"> {{$position}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal" v-if="showHalls">
                        <div class="field-label is-normal">
                            <label class="label">Hall + Floor: </label>
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

                            <div class="field">
                                <div class="control is-expanded">
                                    <div class="select">
                                        <select name="floor" v-model="floor">
                                            <option value="" disabled="">Select Floor</option>
                                            @foreach($floors as $floor)
                                                <option value="{{$floor}}">{{$floor}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Level: </label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control is-expanded">
                                    <div class="select">
                                        <select name="level" v-model="level">
                                            <option value="" disabled>Select Level</option>
                                            @foreach($levels as $level)
                                                <option value="{{$level}}"> {{$level}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <div class="file is-dark has-name" :class="{ 'has-name' : image}">
                            <label class="file-label">
                               <input type="file" name="file" class="file-input" @change="processFile($event)">
                               <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fa fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Upload Candidate Image...
                                    </span>
                               </span>
                               <span class="file-name" v-if="image">
                                   @{{image.name}}
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
                    Successfully Added Candidate: @{{success.first_name}} @{{success.last_name}}
                </modal>
            </div>


        </dashboard>
    </div>

</body>
</html>

<script type="text/javascript" src="js/candidate.js"></script>