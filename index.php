<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Daily Ticket Competition</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://telegram.org/js/telegram-web-app.js"></script>
  <script src="https://unpkg.com/@tonconnect/ui@latest/dist/tonconnect-ui.min.js"></script>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #17212b;
      color: white;
      padding-bottom: 60px; /* Space for the toolbar */
    }

    #user-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #1e2b38;
      padding: 12px 16px;
      border-bottom: 1px solid #2e3b4a;
    }

    #user-header img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    #user-header .info {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 16px;
    }

    #ton-connect1 {
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
    }

    .main {
      padding: 24px;
      text-align: center;
    }

    .main h1 {
      font-size: 24px;
      color: #00bfff;
      margin-bottom: 10px;
    }

    .main p {
      font-size: 16px;
      color: #ccc;
      margin-bottom: 20px;
    }

    #ton-connect-button {
      display: inline-block;
    }

    .toolbar {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: space-around;
      background-color: #1e2b38;
      border-top: 1px solid #2e3b4a;
      height: 60px;
      align-items: center;
    }

    .toolbar button {
      background: none;
      border: none;
      color: #ccc;
      font-size: 14px;
      display: flex;
      flex-direction: column;
      align-items: center;
      cursor: pointer;
    }

    .toolbar button.active {
      color: #00bfff;
    }

    .toolbar button i {
      font-size: 20px;
      margin-bottom: 4px;
    }

    .content-section {
      display: none;
      padding: 20px;
    }

     .content-section.active {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .stats-box {
      background-color: #1e2b38;
      padding: 20px;
      border-radius: 12px;
      margin: 15px 0;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 0 10px rgba(0, 191, 255, 0.2);
    }

    .stats-box h2 {
      margin: 0 0 10px 0;
      font-size: 18px;
      color: #00bfff;
    }

    .stats-box p {
      margin: 0;
      font-size: 20px;
      font-weight: bold;
      color: #ffffff;
    }

    .countdown {
      font-size: 26px;
      font-weight: bold;
      color: #ffcc00;
    }

     .ticket-info {
      background-color: #1e2b38;
      padding: 20px;
      border-radius: 12px;
      margin: 15px 0;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 0 10px rgba(0, 191, 255, 0.2);
    }

    .ticket-info h2 {
      margin-top: 0;
      color: #00bfff;
    }

    .ticket-status {
      margin-top: 10px;
      font-size: 18px;
    }

    .ticket-status.owned {
      color: #00bfff;
    }

    .ticket-status.none {
      color: #00bfff;
    }

     .buyer-list {
      width: 100%;
     display: flex;
      flex-direction: column;
      max-width: 400px;
      gap: 12px;
      margin-top: 20px;
    }

    .buyer-item {
      background-color: #1e2b38;
      padding: 15px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      box-shadow: 0 0 8px rgba(0, 191, 255, 0.15);
      font-size: 16px;
      width: 90%;
    }

    .buyer-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 15px;
      object-fit: cover;
    }

    .buyer-info {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .buyer-name {
      font-weight: bold;
      color: #00bfff;
      text-decoration: none;
    }

    .buyer-tickets {
      color: #ccc;
      font-size: 14px;
    }

  </style>
</head>
<body>

  <div id="user-header">
    <div class="info">
      <img id="user-photo" src="https://via.placeholder.com/40/888/fff?text=👤" alt="User">
      <span id="user-name">Loading...</span>
    </div>
   <div id="ton-connect"></div>
  </div>

 <div id="home" class="content-section active">
  <h1>Welcome to the Daily Ticket Competition</h1>
  <div class="stats-box">
    <h2>Total TON in Pool:</h2>
    <p id="tonPool">Loading...</p>
  </div>
  <div class="stats-box">
    <h2>Total Tickets Bought:</h2>
    <p id="ticketCount">Loading...</p>
  </div>
  <div class="stats-box">
    <h2>Countdown to Draw (UTC):</h2>
    <p class="countdown" id="countdown">--:--:--</p>
  </div>
</div>


<div id="buyers" class="content-section">
  <h1>Users Who Bought Tickets</h1>
  <div class="buyer-list">

    <div class="buyer-item">
      <img src="https://placehold.co/50x50" alt="avatar" class="buyer-avatar">
      <div class="buyer-info">
        <a href="https://t.me/john_doe" class="buyer-name">@john_doe</a>
        <span class="buyer-tickets">3 tickets</span>
      </div>
    </div>
    <div class="buyer-item">
      <img src="https://placehold.co/50x50" alt="avatar" class="buyer-avatar">
      <div class="buyer-info">
        <a href="https://t.me/alice" class="buyer-name">@alice</a>
        <span class="buyer-tickets">1 ticket</span>
      </div>
    </div>
    <div class="buyer-item">
      <img src="https://placehold.co/50x50" alt="avatar" class="buyer-avatar">
      <div class="buyer-info">
        <a href="https://t.me/bob_the_builder" class="buyer-name">@bob_the_builder</a>
        <span class="buyer-tickets">5 tickets</span>
      </div>
    </div>
  </div>
</div>


<div id="buyticket" class="content-section">
  <h1>Buy a Ticket</h1>
  <div class="ticket-info">
    <h2>About the Contest</h2>
    <p>Each ticket costs 0.5 TON. A draw is held daily at 00:00 UTC. One winner takes the entire pool!</p>
    <button id="buyBtn" style="margin-top: 15px; padding: 10px 20px; font-size: 16px; background-color: #00bfff; color: white; border: none; border-radius: 8px; cursor: pointer;">Buy Ticket</button>
    <div class="ticket-status owned">✅ You own 2 tickets for today’s draw.</div>
    <!-- If user owns no ticket: <div class="ticket-status none">❌ You don't have any ticket yet.</div> -->
  </div>
</div>

<div class="toolbar">
  <button onclick="switchTab('home')" class="active">
    <i class="fas fa-home"></i>
    Home
  </button>
  <button onclick="switchTab('buyers')">
    <i class="fas fa-users"></i>
    Buyers
  </button>
  <button onclick="switchTab('buyticket')">
    <i class="fas fa-ticket"></i>
    Buy Ticket
  </button>
</div>

<script>
  function switchTab(tab) {
    document.querySelectorAll('.content-section').forEach(el => el.classList.remove('active'));
    document.getElementById(tab).classList.add('active');

    document.querySelectorAll('.toolbar button').forEach(btn => btn.classList.remove('active'));
    event.target.closest('button').classList.add('active');
  }

    // Simulated fetches (replace with real fetch from backend)
  document.getElementById('tonPool').textContent = '123.45 TON';
  document.getElementById('ticketCount').textContent = '98 tickets';

  // Simulated fetches (replace with real fetch from backend)
  document.getElementById('tonPool').textContent = '123.45 TON';
  document.getElementById('ticketCount').textContent = '98 tickets';

  // Countdown Clock to UTC Midnight
  function updateCountdown() {
    const now = new Date();
    const utcNow = new Date(now.toUTCString());
    const nextMidnight = new Date(Date.UTC(utcNow.getUTCFullYear(), utcNow.getUTCMonth(), utcNow.getUTCDate() + 1, 0, 0, 0));
    const diff = nextMidnight - utcNow;

    const hours = Math.floor(diff / 1000 / 60 / 60);
    const minutes = Math.floor((diff / 1000 / 60) % 60);
    const seconds = Math.floor((diff / 1000) % 60);

    document.getElementById('countdown').textContent = 
      `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
  }

  setInterval(updateCountdown, 1000);
  updateCountdown();
</script>
  
  <script>
    const tg = window.Telegram.WebApp;
    tg.ready();
    tg.expand();

    const user = tg.initDataUnsafe.user;

    document.getElementById("user-name").textContent = `${user.first_name || ''} ${user.last_name || ''}`.trim();
    const avatar = document.getElementById("user-photo");
    avatar.src = user.photo_url || "https://via.placeholder.com/40/888/fff?text=👤";

const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
        manifestUrl: 'https://dailyticketcompetition.infy.uk/tonconnect-manifest.json',
        buttonRootId: 'ton-connect'
    });

    async function connectToWallet() {
        const connectedWallet = await tonConnectUI.connectWallet();
        // Do something with connectedWallet if needed
        console.log(connectedWallet);
    }

    // Call the function
    connectToWallet().catch(error => {
        console.error("Error connecting to wallet:", error);
    });

document.getElementById("buyBtn").onclick = async () => {
      const nanoTON = (0.1 * 1e9).toString();

      const tx = {
        validUntil: Math.floor(Date.now() / 1000) + 600,
        messages: [{
          address: "EQCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX", // Placeholder wallet address
          amount: nanoTON,
        }]
      };

      try {
        const result = await tonConnectUI.sendTransaction(tx);

        const response = await fetch("../backend/verify_payment.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ tx_hash: result.boc, amount: 0.1 })
        });

        const data = await response.json();
        alert(data.success ? "Payment verified!" : "Payment not found.");
      } catch (e) {
        alert("Transaction failed or cancelled.");
      }
    };
  </script>

</body>
</html>