// script.js - Simple JavaScript untuk Barbershop
function showWelcome() {
    alert("Selamat datang di Ada Barbershop!");
}

function changeHeader() {
    document.getElementById("header").style.backgroundColor = "#555";
}

function showDateTime() {
    const now = new Date();
    document.getElementById("datetime").innerHTML = now.toLocaleString();
}