function translate(a){$.ajax({type:"POST",contentType:"application/json; charset=utf-8",url:"/index.php/api/language",data:JSON.stringify(a),dataType:"json",success:function(b){location.reload()}})};