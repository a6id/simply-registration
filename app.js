function updateTime() {
    const now = new Date();
    const time = now.toLocaleTimeString(); 
    document.getElementById("time").textContent = time;
}
setInterval(updateTime, 1000); 
updateTime(); 