"use strict";

window.addEventListener("DOMContentLoaded", function() {search()});

function search() {
    document.getElementById("lookup").addEventListener("click", function() {
        fetch("world.php?country=" + $("#country").val())
            .then(response => {
                return response.text();
            })
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
    });
}