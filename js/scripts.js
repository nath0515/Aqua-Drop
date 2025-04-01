/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

    var is_visible = false;

    function see(){
        var input = document.getElementById("password");
        var see = document.getElementById("see");


        if(is_visible){
            input.type = 'password';
            is_visible = false;
            see.style.color = 'gray';
        }else{
            input.type = 'text';
            is_visible = true;
            see.style.color = 'red';
        }
    }
    function check(){
        var input = documentFragment.getElementById("password").value;

        input = input.trim();
        document.getElementById("password").value = input;
        document.getElementById("count").innerText = "Length : " + input.length;
        
        if (input.length >= 5){
            document.getElementById("check0").style.color = "green";
        }else{
            document.getElementById("check0").style.color = "red";
        }

        if (input.length <= 10){
            document.getElementById("check1").style.color = "green";
        }else{
            document.getElementById("check1").style.color = "red";
        }

        if (input.match(/[0-9]/i)){
            document.getElementById("check2").style.color = "green";
        }else{
            document.getElementById("check2").style.color = "red";
        }

        if (input.match(/[^A-Za-z0-9'']/i)){
            document.getElementById("check3").style.color = "green";
        }else{
            document.getElementById("check3").style.color = "red";
        }

        if (input.match('')){
            document.getElementById("check4").style.color = "green";
        }else{
            document.getElementById("check4").style.color = "red";
        }
    }
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }





});
