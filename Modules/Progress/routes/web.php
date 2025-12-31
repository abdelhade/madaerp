<?php

use Illuminate\Support\Facades\Route;
use Modules\Progress\Http\Controllers\{
    DailyProgressController,
    WorkItemController,
    ProjectItemController,
    ProjectTypeController,
    ProjectTemplateController,
    ProjectProgressController,
    WorkItemCategoryController,
    IssueController,
    ItemStatusController
};

Route::middleware(['auth'])->group(function () {
    Route::resource('item-statuses', ItemStatusController::class)->names('item-statuses');
    Route::resource('project-types', ProjectTypeController::class)->names('project.types');
    Route::post('work-items/reorder', [WorkItemController::class, 'reorder'])->name('work.items.reorder');
    Route::resource('work-items', WorkItemController::class)->names('work.items');
    Route::resource('work-item-categories', WorkItemCategoryController::class)->names('work-item-categories');
    Route::get('issues/kanban', [IssueController::class, 'kanban'])->name('issues.kanban');
    Route::post('issues/update-status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
    Route::resource('issues', IssueController::class)->names('issues');
    Route::post('issues/{issue}/comments', [IssueController::class, 'storeComment'])->name('issues.comments.store');
    Route::delete('issues/comments/{comment}', [IssueController::class, 'destroyComment'])->name('issues.comments.destroy');
    Route::delete('issues/attachments/{attachment}', [IssueController::class, 'destroyAttachment'])->name('issues.attachments.destroy');
    Route::resource('project-template', ProjectTemplateController::class)->names('project.template');
    // Route::resource('project-items', ProjectItemController::class)->names('project.items');
    Route::resource('progress-projcet', ProjectProgressController::class)->names('progress.projcet');
    Route::resource('daily-progress', DailyProgressController::class)->names('daily.progress');

    Route::prefix('projects/{project}')->middleware('auth')->group(function () {
        Route::post('/items', [ProjectItemController::class, 'store'])->name('project-items.store');
        Route::put('/items/{projectItem}', [ProjectItemController::class, 'update'])->name('project-items.update');
        Route::delete('/items/{projectItem}', [ProjectItemController::class, 'destroy'])->name('project-items.destroy');
    });
    Route::get('/projects/progress/{project}', [ProjectProgressController::class, 'progress'])
        ->name('projects.progress/state');

    Route::get('/daily-progress/executed-today', [DailyProgressController::class, 'executedToday']);
});
