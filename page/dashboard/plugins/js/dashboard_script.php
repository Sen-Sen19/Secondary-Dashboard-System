
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

  // // OPTIONAL: DRAGGABLE PANEL
  // let isPanelDragging = false;
  // let panelOffsetX = 0, panelOffsetY = 0;

  // panel.addEventListener('mousedown', (e) => {
  //   isPanelDragging = true;
  //   panelOffsetX = e.clientX - panel.getBoundingClientRect().left;
  //   panelOffsetY = e.clientY - panel.getBoundingClientRect().top;
  // });

  
  // document.addEventListener('mousemove', (e) => {
  //   if (isPanelDragging) {
  //     const left = e.clientX - panelOffsetX;
  //     const top = e.clientY - panelOffsetY;
  //     panel.style.left = `${left}px`;
  //     panel.style.top = `${top}px`;
  //   }
  // });

  // document.addEventListener('mouseup', () => {
  //   isPanelDragging = false;
  // });

  </script>