<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Binary Downline with Personal Referrals Highlighted</title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .binary-node {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin: 0.5rem;
    }
    .binary-node__content {
      background-color: #1F2937; /* gray-800 */
      color: #fff;
      padding: 0.5rem 1rem;
      border-radius: 0.5rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      text-align: center;
      min-width: 8rem;
      position: relative;
    }
    /* Highlight personal referrals (level 1) */
    .binary-node.personal > .binary-node__content {
      border: 2px solid #FBBF24; /* yellow-400 */
    }
    .binary-node__children {
      display: flex;
      justify-content: space-between;
      width: 100%;
      margin-top: 1rem;
      position: relative;
    }
    /* connector lines */
    .binary-node__children::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      width: 0;
      height: 1rem;
      border-left: 2px solid #4B5563;
    }
    .binary-node__children > .binary-node:first-child::before {
      content: '';
      position: absolute;
      top: 0;
      right: 50%;
      width: 50%;
      border-top: 2px solid #4B5563;
    }
    .binary-node__children > .binary-node:last-child::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      width: 50%;
      border-top: 2px solid #4B5563;
    }
  </style>
</head>
<body class="bg-gray-100 p-6">
  <h1 class="text-2xl font-bold mb-4">Binary Downline with Personal Referrals Highlighted</h1>
  <div class="p-4 bg-white rounded-lg overflow-auto">
    <div class="flex justify-center">
      <!-- Root Node -->
      <div class="binary-node">
        <div class="binary-node__content">
          <div class="font-semibold">Affiliate Root</div>
          <div class="text-sm text-gray-400">affiliate@example.com</div>
        </div>

        <!-- Level 1: personal referrals -->
        <div class="binary-node__children w-full">
          <!-- Left Referral -->
          <div class="binary-node personal">
            <div class="binary-node__content">
              <div class="font-semibold">User One</div>
              <div class="text-sm text-gray-400">user.one@example.com</div>
            </div>
            <!-- Note: Level 2 children omitted for brevity -->
          </div>

          <!-- Right Referral -->
          <div class="binary-node personal">
            <div class="binary-node__content">
              <div class="font-semibold">User Two</div>
              <div class="text-sm text-gray-400">user.two@example.com</div>
            </div>
            <!-- Level 2 children omitted -->
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
