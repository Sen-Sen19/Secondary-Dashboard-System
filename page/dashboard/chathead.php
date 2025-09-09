<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../dist/img/tir-logo.png" type="image/png">
  <title>Secondary Process Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="../../plugins/bootstrap/js/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>




  <style>
    body {
      background-color: rgb(255, 255, 255);
      color: white;
    }

    .container {
      padding: 50x;
      border-radius: 8px;
      background-color: rgb(245, 245, 245);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .navbar {
      background-color: rgb(58, 58, 58);
    }

    .navbar-brand img {
      height: 30px;
      margin-right: 10px;
    }

    .btn-back {
      color: white;
      border-color: white;
    }

    .btn-back:hover {
      background-color: black;
      color: #121212;
    }
    #filterChathead {
  position: fixed;
  top: 50%;
  left: 10px;
  width: 50px;
  height: 50px;
  background-color: #343a40;
  color: white;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: grab;
  z-index: 1000;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
  transition: all 0.3s ease;
}

  #filterChathead i {
    font-size: 20px;
    color: white;
  }

  #filterPanel {
    position: fixed;
    z-index: 999;
    background-color: #343a40;
    color: white;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    padding: 15px;
    display: none;
    max-width: 90vw;
    cursor: move;
  }

  .bounce {
    animation: bounce 0.3s ease;
  }

  @keyframes bounce {
    0% { transform: translateX(0); }
    40% { transform: translateX(-10px); }
    70% { transform: translateX(5px); }
    100% { transform: translateX(0); }
  }

  

  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="../../dist/img/tir-logo.png" alt="Logo">
        <span>Secondary Process Dashboard</span>
      </a>
      <a href="../../index.php" class="btn btn-outline-light btn-back">Back</a>
    </div>
  </nav>
  <div id="filterChathead">
  <i class="fas fa-filter" style="color: white; font-size: 20px;"></i>
</div>



<div id="filterPanel">
  <div class="container-fluid mt-4">
    <div class="row">
      <div class="col-md-12">

          <form>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="dateFrom">Date From:</label>
                <input type="date" class="form-control" id="dateFrom">
              </div>
              <div class="form-group col-md-3">
                <label for="dateTo">Date To:</label>
                <input type="date" class="form-control" id="dateTo">
              </div>
              <div class="form-group col-md-3">
                <label for="dropdown">Select Option:</label>
                <select class="form-control" id="dropdown">
                  <option value="" disabled selected>Choose...</option>
                  <option value="Section 1">Section 1</option>
                  <option value="Section 2">Section 2</option>
                  <option value="Section 3">Section 3</option>
                  <option value="Section 3.1">Section 3.1</option>
                  <option value="Section 4">Section 4</option>
                  <option value="Section 5">Section 5</option>
                  <option value="Section 6">Section 6</option>
                  <option value="Section 7">Section 7</option>
                  <option value="Section 9">Section 9</option>
                  <option value="Battery">Battery</option>
                  <option value="Overall">Overall</option>
              
                </select>
              </div>
              <div class="form-group col-md-3 d-flex align-items-end">
                <label for="generateBtn" class="d-none">Generate</label>
                <button type="button" class="btn btn-primary btn-block" id="generateBtn">Generate</button>
              </div>
            </div>
          </form>
   
      </div>
    </div>
  </div>
</div>

  <script>
  const chathead = document.getElementById('filterChathead');
  const panel = document.getElementById('filterPanel');

  let offsetX = 0, offsetY = 0;
  let isDragging = false;
  let justDragged = false;

  // CHATHEAD DRAG
  chathead.addEventListener('mousedown', (e) => {
    isDragging = true;
    justDragged = false;
    offsetX = e.clientX - chathead.getBoundingClientRect().left;
    offsetY = e.clientY - chathead.getBoundingClientRect().top;
    chathead.style.transition = "none";
  });

  document.addEventListener('mousemove', (e) => {
    if (isDragging) {
      justDragged = true;
      const left = e.clientX - offsetX;
      const top = e.clientY - offsetY;
      chathead.style.left = `${left}px`;
      chathead.style.top = `${top}px`;
      chathead.style.right = 'auto';
      chathead.style.bottom = 'auto';

      movePanelNearChathead(left, top);
    }
  });

  document.addEventListener('mouseup', () => {
    if (isDragging) {
      isDragging = false;
      chathead.style.transition = "all 0.3s ease";

      const screenW = window.innerWidth;
      const screenH = window.innerHeight;
      const rect = chathead.getBoundingClientRect();
      const chatW = rect.width;
      const chatH = rect.height;

      let newLeft = rect.left;
      let newTop = rect.top;

      if (rect.left < screenW / 2) {
        newLeft = 10;
      } else {
        newLeft = screenW - chatW - 10;
      }

      if (rect.top < 50) {
        newTop = 10;
      } else if (rect.bottom > screenH - 50) {
        newTop = screenH - chatH - 10;
      }

      chathead.style.left = `${newLeft}px`;
      chathead.style.top = `${newTop}px`;

      movePanelNearChathead(newLeft, newTop);

      chathead.classList.add('bounce');
      setTimeout(() => chathead.classList.remove('bounce'), 300);
    }
  });

  // CLICK CHATHEAD TO TOGGLE FILTER
  chathead.addEventListener('click', () => {
    if (justDragged) {
      justDragged = false;
      return;
    }

    const rect = chathead.getBoundingClientRect();
    const isVisible = panel.style.display === 'block';

    if (!isVisible) {
      panel.style.display = 'block';
      movePanelNearChathead(rect.left, rect.top);
    } else {
      panel.style.display = 'none';
    }
  });

  // CLICK OUTSIDE TO CLOSE
  document.addEventListener('click', (e) => {
    if (!panel.contains(e.target) && !chathead.contains(e.target)) {
      panel.style.display = 'none';
    }
  });

  // REPOSITION PANEL BASED ON CHATHEAD
  function movePanelNearChathead(x, y) {
    const screenW = window.innerWidth;
    const panelW = panel.offsetWidth || 400;
    const padding = 10;

    let left = (x + 60 + panelW > screenW) ? x - panelW - padding : x + 60;
    panel.style.left = `${Math.max(padding, left)}px`;
    panel.style.top = `${y}px`;
  }

  // OPTIONAL: DRAGGABLE PANEL
  let isPanelDragging = false;
  let panelOffsetX = 0, panelOffsetY = 0;

  panel.addEventListener('mousedown', (e) => {
    isPanelDragging = true;
    panelOffsetX = e.clientX - panel.getBoundingClientRect().left;
    panelOffsetY = e.clientY - panel.getBoundingClientRect().top;
  });

  
  document.addEventListener('mousemove', (e) => {
    if (isPanelDragging) {
      const left = e.clientX - panelOffsetX;
      const top = e.clientY - panelOffsetY;
      panel.style.left = `${left}px`;
      panel.style.top = `${top}px`;
    }
  });

  document.addEventListener('mouseup', () => {
    isPanelDragging = false;
  });
</script>

</body>

</html>
