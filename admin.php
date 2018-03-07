<php> 
<html>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
  </script>
  <script src="admin-read.js">
  </script>
  <script src="https://use.fontawesome.com/4b7695557b.js">
  </script>   
  <link href="appDecision.css" rel="stylesheet" type="text/css">
  <link href="appDecisionRead.css" rel="stylesheet" type="text/css">
          

          
  <title></title>
        
    <script>
      function aeCheckKey(ns_event, action, target_key, theForm){
        var keypressed;
        if(navigator.appName.indexOf("Microsoft") >= 0)
        {
          keypressed = event.keyCode;
        }
        else
        {
          keypressed = ns_event.which;
        }

        if(keypressed == target_key)
        {
          eval(action+'(theForm)');
        }
      }

      function aeTrapEnter(ns_event, action, theForm){
        aeCheckKey(ns_event, action, 13, theForm);
      }

     function saastaSubmitForm(formin) 
     {
        if(formin.brownie == null)
        {
          alert('Form must define brownie field');
          return;
        }
        formin.brownie.value = '{$brownie}';
        formin.submit();
     }

     function saastaSubmitLink(formin, linkin) 
     {
        formin.action=linkin;
        saastaSubmitForm(formin);
     }

      document.domain = 'byu.edu';
    </script>
    <form name='headerform'>
    <input type='hidden' name='brownie'>
    </form>

  <script>
    function saveReaders()
    {
      document.getElementById('gldata').style.display = 'inline';
    }

    
  </script>


  <form name='theform' method=POST>
  <input type=hidden name=brownie value=''>
  <input type=hidden name=c value=''>
  <input type=hidden name=e value=''>
  <input type=hidden name=read_note value=''>

	<div class="wrapper">
		<h1 class="gray header-select-left" id="reads">Reads</h1>
		<h1 class="header-select-right" id="team-leader">Admin</h1>
		<div class="gray sub-header">
			Fall 2017 Application
		</div>
				<br>
		<div class="full-header">
			Read Pool Summary
		</div>
		<div class="left team-items" id="total-wrapper">
			<p id="total-title">Team Total</p>
			<p class="blue bold text" id="team-total">{$total_count}</p>
		</div>
		<div class="left team-items" id="total-read-wrapper">
			<p id="queue-title">Team Queue</p>
			<p class="blue bold text" id="team-queue">{$total_queue}</p>
		</div>
		<!--<div class="left team-items" id="total-read-week">
			<p id="queue-title">Total Read This Week</p>
			<p class="blue bold" id="team-queue">981</p>
		</div>--><br>
		<br>
		
			{$table}
		<br><br><br>
		<br><br><br>
		<div class="full-header">
			Items for Your Attention
		</div>
		<div class="section">
			{$attentionTable}
			
		</div>
		<br><br>
	</div>
	
</form>
</html>
