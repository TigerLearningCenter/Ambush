var mongo = require('mongodb').MongoClient,
    client = require('socket.io').listen(8080).sockets;
 
    mongo.connect('mongodb://127.0.0.1/27017', function(err,db){
        if(err) throw err;
 
          client.on('connection',function(socket){
 
            var col = db.collection('message'),
                sendStatus = function(s){
                  socket.emit('status',s);
                };
 
                col.find().limit(100).sort({_id:1}).toArray(function(err,res){
                    if(err) throw err;
                    socket.emit('output',res);
                });
 
            //wait for input
            socket.on('input', function(data){
                var name = data.name;
                var message = data.message;
 
                whitespace = /^\s*$/;
 
                if(whitespace.test(name) || whitespace.test(message))
                {
                    sendStatus('Name and Message Required');
                }
                else
                {
                    col.insert({name: name,message:message}, function(){
 
                        //emit latest messages to all clients
                        client.emit('output',[data]);
 
                        sendStatus({
                            message:"Message sent",
                            clear:true
                        });
                    });
                }
 
            });
         });
    });