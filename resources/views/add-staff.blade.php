<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>Add Staff</title>
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

        .staff-key{
            border-bottom: 3px solid white;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div id="root" v-cloak>
        <loading-modal v-if="loading" content="Adding Staff..."> </loading-modal>
        <dashboard :link="'/add-staff'" admin={{$admin}}>
            <div class="box">
                <form method="POST" action="/import" enctype="multipart/form-data" class="" @submit.prevent="submit">
                    <h1>add staff.</h1>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Name: </label>
                        </div>
                        <div class="field-body">

                            <div class="field">
                                <div class="control is-expanded">
                                    <input type="text" class="input" placeholder="First Name" v-model="firstName">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control is-expanded">
                                    <input type="text" class="input" placeholder="Last Name" v-model="lastName">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Phone Number: </label>
                        </div>
                        <div class="field-body">

                            <div class="field">
                                <div class="control is-expanded">
                                    <input type="text"class="input" placeholder="Phone Number" v-model="phone">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label">Username: </label>
                        </div>
                        <div class="field-body">

                            <div class="field">
                                <div class="control is-expanded">
                                    <input type="text" class="input" placeholder="Username" v-model="username">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label"> Assigned Hall:</label>
                        </div>
                        <div class="field-body">
                            <div class="field is-narrow">
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select v-model="hall">
                                            <option value="" disabled>Select Assigned Hall</option>
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

                <modal v-if="showModal && error" @close="showModal = false; error='' " :green="false">
                    @{{error}}
                </modal>

                <modal v-if="showModal && success" @close="showModal = false; success='' " :green="true">
                    Successfully Added Staff: @{{success.first_name}} @{{success.last_name}} <br/> The password is <span class="staff-key"> @{{success.key}}</span>
                </modal>
            </div>


        </dashboard>
    </div>

</body>
</html>

<script type="text/javascript" src="js/staff.js"></script>