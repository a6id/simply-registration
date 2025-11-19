function updateTime() {
    const now = new Date();
    const time = now.toLocaleTimeString(    [], { hour: '2-digit', minute: '2-digiwwt' }  ); 
    document.getElementById("time").textContent = time;
}
setInterval(updateTime, 1000); 
updateTime(); 