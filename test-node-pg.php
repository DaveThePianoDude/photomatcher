<!DOCTYPE html>
<html>

	 <head>
	  
		<title>Now+Then PhotoMatcher</title>

		<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>

		<script type="text/javascript">
		
			var pg = require('pg');
			//var conString = "postgres://username:password@localhost/database";
			
			//var conString = "dbname=d2uj6hdbhq6rtc host=ec2-54-197-237-120.compute-1.amazonaws.com port=5432 user=jpsgrwfbyyulbb password=a9U30GMw2oMsgMhoqhmwDP4jaT sslmode=require";

			//this initializes a connection pool
			//it will keep idle connections open for a (configurable) 30 seconds
			//and set a limit of 20 (also configurable)
			pg.connect(process.env.DATABASE_URL, function(err, client, done) {
			  if(err) {
				alert(err);
				return console.error('error fetching client from pool', err);
			  }
			  client.query('SELECT $1::int AS number', ['1'], function(err, result) {
				//call `done()` to release the client back to the pool
				done();

				if(err) {
				  return console.error('error running query', err);
				}
				console.log(result.rows[0].number);
				//output: 1
			  });
			});
				
		</script>
	
	</head>
	
</html>