$(document).ready(function(){ 
    $.get("{{url('api/departamento')}}",function(ls){
        for (var i =  1; i < ls.length; i++) {
            $("#dep").append('<option value="'+ls[i].dDepartamento+'">'+ls[i].Descripcion+'</option>');
        }
        provincia($("#dep").val());
    });
    function provincia(i) {
        $("#pro option").remove();
        $.get("{{url('api/provincia')}}/"+i,function(ls){
            for (var i =  1; i < ls.length; i++) {
                $("#pro").append('<option value="'+ls[i].codProvincia+'">'+ls[i].Descripcion+'</option>');
            }
            distrito($("#dep").val(),$("#pro").val());
        });
    }
    function distrito(i,j) {
        $("#dis option").remove();
        $.get("{{url('api/distrito')}}/"+i+"/"+j,function(ls){
            for (var i =  1; i < ls.length; i++) {
                $("#dis").append('<option value="'+ls[i].codProvincia+'">'+ls[i].Descripcion+'</option>');
            }
        });
    }
    $('#dep').on('change', function(){
        provincia($("#dep").val());
    });
    $('#pro').on('change', function(){
        distrito($("#dep").val(),$("#pro").val());
    });                    
});