<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <script src="https://cdn.tailwindcss.com"></script>
<script>
  function timer() {
    const display  = document.getElementById("display");
    const progress = document.getElementById("progress");

    const WARN_THRESHOLD   = 0.4;
    const DANGER_THRESHOLD = 0.2;
    const INIT_TIME = 15;
    let timeRemaining = INIT_TIME;

    (async () => {
      while (timeRemaining > 0) {
        timeRemaining--;
        display.innerText = `${timeRemaining}s`;

        const frac = timeRemaining / INIT_TIME;
        progress.style.width = `${frac * 100}%`;

        // swap Tailwind color classes
        progress.classList.remove("bg-green-400", "bg-yellow-400", "bg-red-600");
        if (frac > WARN_THRESHOLD) {
          progress.classList.add("bg-green-400");
        } else if (frac > DANGER_THRESHOLD) {
          progress.classList.add("bg-yellow-400");
        } else {
          progress.classList.add("bg-red-600");
        }

        await new Promise(r => setTimeout(r, 1000));
      }

      // Countdown complete
      console.log("⏰ Timer completed!");
    })();
  }
</script>

</head>
<body onload="timer()" class="bg-gray-50 flex items-center justify-center min-h-screen">
  <div class="flex flex-col items-center space-y-4">
    <!-- timer text -->
    <div id="display" class="text-5xl font-extrabold text-red-600">15s</div>

    <!-- progress bar container -->
    <div class="w-48 h-5 border border-gray-300 rounded overflow-hidden">
      <!-- progress fill -->
      <div
        id="progress"
        class="h-full bg-green-400 transition-[width] duration-100 ease-linear"
        style="width:100%;"
      ></div>
    </div>
  </div>
</body>
</html>
