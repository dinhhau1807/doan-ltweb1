$(document).ready(function() {
    //active tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //get doms
    const logoutBtn = $('#logout');
    
    
    logoutBtn.click(function() {
        window.location.href = "./logout.php";
    });
});