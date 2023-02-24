const loadFullImage = (event) => {
  event.currentTarget.onload = null;
  event.currentTarget.src = event.currentTarget.src.replace('-test', '');
}
