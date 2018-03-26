<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>Add a Student</title>
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
        <loading-modal v-if="loading" content="Adding The Student..."> </loading-modal>
        <dashboard :link="'/add-student'" admin={{$admin}}> 
            <div class="box">
                <form method="POST" action="/add-stunt" enctype="multipart/form-data" @submit.prevent="addStudent">
                    <h1>Add A Student</h1>

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
                            <label class="label">Matric Number: </label>
                        </div>
                        <div class="field-body">

                            <div class="field">
                                <div class="control is-expanded">
                                    <input type="text" name="matricNumber" class="input matric" placeholder="Matric Number" v-model="matricNumber">
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
                                            <option disabled value="">Select Hall</option>
                                            @foreach($halls as $hall)
                                                <option value="{{$hall}}"> {{$hall}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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