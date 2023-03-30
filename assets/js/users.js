async function get_users(){
    await fetch('../../api/get_users.php', {}).then(function(response){
        response.json().then(function(json){
            console.log(json);
        });
    });
}