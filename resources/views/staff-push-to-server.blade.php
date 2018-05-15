<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{csrf_token()}}">
<meta charset="utf-8">
<head>
	<title>Staff | Push To Server</title>
	<link rel="stylesheet" type="text/css" href="/css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="/css/font awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/css/staff-push-to-server.css">
</head>
<body>
	<div id="root" v-cloak>
		<staff-dashboard link="/staff/push-to-server" staff={{$staff}}>
            <h2>{{$hall}} <hr/></h2>
            <div class="columns container">
                <h1 class="time-pushed">Last Time you pushed was: @{{lastPushed}} <hr/></h1>

                <label href="#" class="button is-primary is-outlined container server" :class="{'is-loading' : pushLoading}"  @click.prevent="pushServer">Push to server 🚀</label>
            </div>
        </staff-dashboard>
		
        <modal :green="true" v-if="showModal && pushSuccess" @close="showModal = false; pushSuccess=''"> 
            Successfully Pushed Votes to server at: @{{lastPushed}}
        </modal>

        <modal :green="false" v-if="showModal && pushFailure" @close="showModal = false; pushFailure=''"> 
            Can't Push to server. Please ensure your internet connection is stable!
        </modal>
	</div>
</body>
</html>

<script type="text/javascript" src="/js/staff.js"></script>

