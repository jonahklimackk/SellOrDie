<style>
  .checkmark-animation {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #1F2937; /* updated background color */
    padding: 1rem 2rem;
    border-radius: 0.5rem;
    color: #fff;
    font-family: 'Digital-7', monospace;
    position: relative;
    overflow: hidden;
  }

  .checkmark {
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    border: 3px solid #10B981;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    animation: pop 0.5s ease-out forwards;
  }

  .checkmark::before {
    content: '✓';
    font-size: 1rem;
    opacity: 0;
    transform: scale(0);
    animation: mark 0.3s 0.5s ease-out forwards;
  }

  @keyframes pop {
    0%   { transform: scale(0); }
    80%  { transform: scale(1.2); }
    100% { transform: scale(1); }
  }

  @keyframes mark {
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .credits-text {
    font-size: 1.25rem;
  }
</style>

<div class="checkmark-animation">
  <div class="checkmark"></div>
  <div class="credits-text">
    You just earned 
    <span id="credits" data-target="20">0</span> credits.
  </div>
</div>

<script>
  const creditsEl = document.getElementById('credits');
  const target = parseInt(creditsEl.dataset.target, 10);

  let count = 0;
  const startDelay = 150;  // ms at count = 0
  const endDelay   = 10;   // ms at count = target

  function tick() {
    if (count < target) {
      count++;
      creditsEl.textContent = count;

      // how far along are we? 0 at start, 1 at end
      const progress = count / target;

      // linearly interpolate delay
      const delay = startDelay + (endDelay - startDelay) * progress;

      setTimeout(tick, delay);
    }
  }

  window.addEventListener('load', () => {
    // restart the checkmark “pop” animation
    const chk = document.querySelector('.checkmark');
    chk.getBoundingClientRect();
    chk.classList.add('animate');

    // kick off the accelerating count-up
    tick();
  });
</script>