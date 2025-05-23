function _(element) {
    return document.querySelector(element);
}

// importan variables.
const currentUserId = _('meta[name="current_user_id"]').getAttribute('content');
let commentToBeDeleted;

// COMMENTS CODE

const taskId = _('meta[name="task_id_reference"]').getAttribute('content');
const commentsList = _('.comments-list'); // element holding all comments.
let allComments = []; // this variable is meant to contain a collection of all comment intances.
console.log('Task ID', taskId);

function getComments() {
    fetch(`/get-comments/${taskId}`)
    .then(res => {
        if (!res.ok) {
            throw new Error('Network response was not ok:', res.status);
        } else {
            return res.json();
        }
    })
    .then(data => {
        allComments = data.comments;
        console.log("Comments:", allComments);
        console.log("task ID:", data.task_id);
        displayComments(allComments);
    })
}

getComments();


function displayComments(comments) {
    commentsList.innerHTML = "";
    console.log(currentUserId);

    if (comments.length < 1) {
        commentsList.innerHTML = `
            <h2>No comments yet</h2>
        `;
    } else {
        comments.forEach(com => {
            const commentCard = document.createElement('li');
            commentCard.classList = 'comment-card';

            commentCard.innerHTML = `
                <div class="comment-header" data-id="${com.id}">
                    <h1>Author: ${com.author.name}</h1>
                    <p>${com.created_att}</p>
                </div>
                
                <div class="comment-text">
                    <p>${com.comment}</p>
                </div>

                ${com.user_id == currentUserId ? `<button class="delete-comment-btn">Delete</button>` : ''}
                
            `;

            commentsList.appendChild(commentCard);
        })
    }
}

// this code is for when a comment is to be deleted.

commentsList.addEventListener('click', e => { //catching the moment the user presses the delete button for a comment
    if (e.target.closest('.delete-comment-btn')) {
        console.log('delete btn clicked');
        getCommentToBeDeletedId(e);
    }
});

document.querySelector('.delete-comment-no').addEventListener('click', showDeleteCommentPopup);

// first we need to know which comment is to be deleted by getting its ID.
function getCommentToBeDeletedId(e) {
    const commentCard = e.target.closest('.comment-card');
    const commentId = commentCard.querySelector('.comment-header').getAttribute('data-id');
    console.log(commentId);
    commentToBeDeleted = commentId;
    showDeleteCommentPopup();
}

function showDeleteCommentPopup() {
    const deleteCommentPopup = _('.delete-comment-popup-wrapper');
    deleteCommentPopup.classList.toggle('active');
}

// if user clicks the yes button when popup is showing then we'll send a request for 
// this comment to be deleted.

document.querySelector('.delete-comment-yes').addEventListener('click', deleteComment);

function deleteComment() {

    const dataObj = {
        'commentId' : commentToBeDeleted
    }

    fetch('/delete-comment',{
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : _('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(dataObj)
    })
    .then(res => {
        if (!res.ok) {
            throw new Error('network response was not ok:', res.status);
        } else {
            return res.json();
        }
    })
    .then(data => {

        if (data.success) {
            console.log('comment was deleted');
            window.location.reload(true);
        }
        
        
    })
    .catch(err => {
        console.error(err);
    })
}
