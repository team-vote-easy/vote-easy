<!DOCTYPE html>
<html>
<meta charset="utf-8">
{{-- <meta name="csrf-token" content="{{csrf_token()}}"> --}}
<head>
    <title>Student Login</title>
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
        position: relative;
       }

       input[type=submit]{
        width: 300px;
        position: relative;
        left: 440px;
       }

       .meh{
        position: relative;
        left: 200px;
       }

       .heh{
        font-family: Montserrat;
        border: 2px solid #b9382e;
       }

       .green{
        border: 2px solid #5eaa4d;
       }

       i.danger-icon{
        color: #ff2b56;
       }
    </style>
</head>
<body>
    <div id="root">
        <div class="container box">
            <form method="POST" action="/student-login" class="container">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                

                <h1>STUDENT LOGIN</h1>

                <div class="field is-horizontal meh">
                    <div class="field-label is-normal">
                        <label class="label">Matric Number: </label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control is-expanded has-icons-left">
                                <input type="text" name="matricNumber" class="input {{$errors->has('matricNumber') || $errors->has('invalid') ? 'is-danger' : ''}}" placeholder="Matric Number" value="{{old('matricNumber')}}">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user-o {{$errors->has('matricNumber') || $errors->has('invalid') ? 'is-danger danger-icon' : ''}}"></i>
                                </span>
                            </div>
                            @if($errors->has('matricNumber'))
                                <p class="help is-danger"> {{$errors->first('matricNumber')}} </p>
                            @endif

                            @if($errors->has('invalid'))
                                <p class="help is-danger"> {{$errors->first('invalid')}} </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal meh">
                    <div class="field-label is-normal">
                        <label class="label"> Password:</label>
                    </div>
                    <div class="field-body">
                        <div class="field is-narrow">
                            <div class="control has-icons-left">
                                <input type="password" name="password" class="input {{$errors->has('password') || $errors->has('invalid') ? 'is-danger' : ''}}" placeholder="Password">
                                <span class="icon is-small is-left">
                                    <i class="fa fa-lock {{$errors->has('password') || $errors->has('invalid') ? 'is-danger danger-icon' : ''}}"></i>
                                </span>
                            </div>
                            @if($errors->has('password'))
                                <p class="help is-danger"> {{$errors->first('password')}} </p>
                            @endif

                            @if($errors->has('invalid'))
                                <p class="help is-danger"> {{$errors->first('invalid')}} </p>
                            @endif
                        </div>
                    </div>
                </div>
            
                <div class="field">
                    <div class="control">
                      <input type="submit" name="Submit" value="Submit" class="button is-danger is-medium">  
                    </div>
                </div>
            </form>

            @if($errors->has('alreadyVoted'))
                <modal v-if="showModal" :green="false" @close="showModal = false;"> {{$errors->first('alreadyVoted')}} </modal>
            @endif

        
        </div>
    </div>

</body>
</html>

<script type="text/javascript" src="js/student.js"></script>