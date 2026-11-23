let seconds = 0;
let timer = null;

function updateDisplay() {
    document.getElementById("display").textContent = seconds;
}

function startTimer() {
    if (timer !== null) return;

    timer = setInterval(function () {
        seconds++;
        updateDisplay();
    }, 1000);
}

function stopTimer() {
    clearInterval(timer);
    timer = null;
}

function resetTimer() {
    stopTimer();
    seconds = 0;
    updateDisplay();
}