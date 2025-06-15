<html>
<head>

	<script>
		function timer() {
			const get = query => document.querySelector(query);
			const wait = s => new Promise(r => setTimeout(r, s * 1000));

			const display = get(".timer .display");
			const progress = get(".timer .progress");

			const WARN_THRESHOLD = .4;
			const DANGER_THRESHOLD = .2;

			const INIT_TIME = 15;
			let timeRemaining = INIT_TIME;



			(async () => {
				while (timeRemaining > 0) {
					timeRemaining--;
					display.innerText = `${timeRemaining}s`;
					const newProgress = timeRemaining / INIT_TIME;
					progress.style.setProperty("--progress", newProgress);
					if (newProgress > WARN_THRESHOLD) {
						progress.style.setProperty("--color", "var(--safe)");
					} else if (newProgress > DANGER_THRESHOLD) {
						progress.style.setProperty("--color", "var(--warn)");
					} else {
						progress.style.setProperty("--color", "var(--danger)");
					}
					await wait(1);
				}
			})();
		}
	</script>

	<style>
		/* CENTER TIMER */
		.timer {
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

/* FLOW TIMER CONTENT */
.timer {
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
	gap: 1rem;
	width: 200px;
}

.timer .progress-container {
	width: 100%;
	border: 1px solid black;
	--height: 20px;
	height: var(--height);
}

:root {
	--safe: lightgreen;
	--warn: yellow;
	--danger: red;
}

.timer .progress {
	--color: var(--safe);
	--progress: 1;
	background-color: var(--color);
	width: 100%;
	height: var(--height);
	transform: scaleX(var(--progress));
	transform-origin: left;
	transition: transform 0.1s, color 0.1s;
}
</style>
</head>
<body onload="timer()">

	<div class="timer">
		<div class="display"></div>
		<div class="progress-container">
			<div class="progress">
			</div>
		</div>
	</div>
</body>
</html>