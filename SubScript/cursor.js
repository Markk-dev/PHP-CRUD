const circleElement = document.querySelector('.circle');

const mouse = { x: 0, y: 0 };
const previousMouse = { x: 0, y: 0 };
const circle = { x: 0, y: 0 };

let currentScale = 0;
let currentAngle = 0;

window.addEventListener('mousemove', (e) => {
  mouse.x = e.clientX; 
  mouse.y = e.clientY; 
});

const speed = 0.10;

const tick = () => {
  
  if (mouse.x < 0 || mouse.x > window.innerWidth || mouse.y < 0 || mouse.y > window.innerHeight) {
    circleElement.style.opacity = '0';
    return; 
  } else {
    circleElement.style.opacity = '1'; 
  }

  
  circle.x += (mouse.x - circle.x) * speed;
  circle.y += (mouse.y - circle.y) * speed;

  
  const circleSize = parseFloat(getComputedStyle(circleElement).getPropertyValue('--circle-size'));
  const translateTransform = `translate(${circle.x - circleSize / 2}px, ${circle.y - circleSize / 2}px)`; 

  const deltaMouseX = mouse.x - previousMouse.x;
  const deltaMouseY = mouse.y - previousMouse.y;

  previousMouse.x = mouse.x;
  previousMouse.y = mouse.y;

  const mouseVelocity = Math.min(Math.sqrt(deltaMouseX ** 2 + deltaMouseY ** 2) * 4, 150);
  const scaleValue = (mouseVelocity / 150) * 0.5;

  currentScale += (scaleValue - currentScale) * speed;
  const scaleTransform = `scale(${1 + currentScale}, ${1 - currentScale})`;

  const angle = Math.atan2(deltaMouseY, deltaMouseX) * (180 / Math.PI);
  if (mouseVelocity > 20) {
    currentAngle = angle;
  }

  const rotateTransform = `rotate(${currentAngle}deg)`;
  circleElement.style.transform = `${translateTransform} ${rotateTransform} ${scaleTransform}`;

  window.requestAnimationFrame(tick);
};


window.addEventListener('mouseleave', () => {
  circleElement.style.opacity = '0'; 
});

tick();
