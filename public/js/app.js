const enableSound = (videoId) => {
  const video = document.querySelector(videoId);
  video.muted = false;
  video.play();
}

const showForSex = (sexo) => {
  const forMen = document.querySelector('#for-men')
  const forWomen = document.querySelector('#for-women')
  if (sexo == 0) {
     forMen.style.display = 'none' 
     forWomen.style.display = 'block' 
  } else {
     forMen.style.display = 'block' 
     forWomen.style.display = 'none' 
  }
}

const botonesEspeciales = document.querySelectorAll('.btn-start');

for (let i = 0; i < botonesEspeciales.length; i++) {
  botonesEspeciales[i].addEventListener('click', function() {
    const video = this.dataset.video;
    enableSound(video)

    const sexo = this.dataset.sex;
    if(sexo) showForSex(sexo);
  });
}
