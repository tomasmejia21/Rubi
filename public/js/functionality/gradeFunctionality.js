function openModal(answer, userId, activityId) {
    // Set the answer in the modal
    document.getElementById('studentAnswer').value = answer;

    // Set the userId and activityId in the form
    document.getElementById('userId').value = userId;
    document.getElementById('activityId').value = activityId;

    // Set the form action
    document.getElementById('gradeForm').action = '/grades/' + userId + '/' + activityId + '/edit';

    // Open the modal
    $('#gradeModal').modal('show');
}
