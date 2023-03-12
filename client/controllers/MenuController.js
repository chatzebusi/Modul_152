/**
 * this function load first thumbnails and after thumbnail is loaded, load normal image
 * @param {String} imagePath
 * @param {Object} image
 * @author Alessio Englert
 */
const imageLoad = (imagePath, image) => {
  image.removeEventListener('load', event)
  image.src = imagePath
}

/**
 * this function upvote the image
 * @param {Object} event
 * @param {Integer} userId
 * @author Alessio Englert
 */
const upVoteImage = (event, userId) => {
  let imageId = event.srcElement.attributes.value.nodeValue

  fetch('http://localhost/server/controllers/UpVoteController.php', {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
    },
    body: `imageId=${imageId}&userId=${userId}`,
  })
}

/**
 * this function downvote the image
 * @param {Object} event
 * @param {Integer} userId
 * @author Alessio Englert
 */
const downVoteImage = (event, userId) => {
  let imageId = event.srcElement.attributes.value.nodeValue

  fetch('http://localhost/server/controllers/DownVoteController.php', {
    method: 'POST',
    credentials: 'include',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
    },
    body: `imageId=${imageId}&userId=${userId}`,
  })
}

export {imageLoad, upVoteImage, downVoteImage}
