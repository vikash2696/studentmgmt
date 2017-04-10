<?php
namespace Student\Message;


interface StudentMessages
{

    const ADD_TITLE_TASK_TYPE = 'Add Task Type';

    const LIST_TASK_TYPE = 'List Task Types';

    const TASK_TYPE = 'Task Type';

    const EDIT_TITLE_TASK_TYPE = 'Edit Task Type';

    const ADD_TASK_TYPE_SUCCESS = 'Task Type added successfully';

    const EDIT_TASK_TYPE_SUCCESS = 'Task Type updated successfully';

    const TASK_TYPE_NOT_FOUND = 'Task Type not found';

    const DELETE_MSG_SUCCESS = 'Message deleted successfully';

    const VALIDATION_EMPTY_TASK_TYPE = 'Please enter Task Type';
}
