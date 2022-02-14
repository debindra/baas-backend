<?php

    use App\Http\Controllers\AgentController;
    use App\Http\Controllers\Alarm\AlarmController;
    use App\Http\Controllers\Backup\BackupServerJobsController;
    use App\Http\Controllers\BackupPolicyController;
    use App\Http\Controllers\BackupServerController;
    use App\Http\Controllers\User\VeeamUserController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\
    {
        AuthController,
        UserController
    };


    Route::group(['middleware' => 'api', 'prefix' => 'v1/agents', 'namespace' => 'Api\V1', 'as' => 'api.'], function ($router) {

        Route::get('/', [AgentController::class, 'index']);
    });

//Backup policies
    Route::group(['middleware' => 'api', 'prefix' => 'v1/backupPolicies', 'namespace' => 'Api\V1', 'as' => 'api.'], function ($router) {

        Route::get('/', [BackupPolicyController::class, 'index']);
    });

    //Backup servers
    Route::group(['middleware' => 'api', 'prefix' => 'v1/backupServers', 'namespace' => 'Api\V1', 'as' => 'api.'], function ($router) {

        Route::get('/', [BackupServerController::class, 'index']);
        Route::get('/{backupServerUid}', [BackupServerController::class, 'getBackupServersById']);

        Route::get('/{backupServerUid}/collect', [BackupServerController::class, 'backupServersCollect']);
        Route::get('/repositories', [BackupServerController::class, 'getBackupServerRepository']);

        Route::get('/{backupServerUid}/repositories', [BackupServerController::class, 'getBackupServerByIdRepository']);

        Route::get('/{backupServerUid}/repositories/{repositoryUid}', [BackupServerController::class, 'getBackupServerByIdRepositoryById']);

        Route::get('/proxies', [BackupServerController::class, 'getBackupServerProxy']);
        Route::get('/{getBackupServerIdProxy}/proxies', [BackupServerController::class, 'getBackupServerIdProxy']);
        Route::get('/servers', [BackupServerController::class, 'getBackupServerServers']);

        //Jobs
        Route::get('/jobs', [BackupServerJobsController::class, 'index']);
        Route::get('/{backupServerUid}/jobs', [BackupServerJobsController::class, 'getJobsByBackupServerId']);
        Route::get('/{backupServerUid}/jobs', [BackupServerJobsController::class, 'getJobsByBackupServerId']);

        Route::get('/jobs/{jobUid}', [BackupServerJobsController::class, 'getJobById']);
        Route::patch('/jobs/{jobUid}', [BackupServerJobsController::class, 'updateJob']);
        Route::get('/jobs/{jobUid}/start', [BackupServerJobsController::class, 'jobStart']);
        Route::get('/jobs/{jobUid}/stop', [BackupServerJobsController::class, 'jobStop']);
        Route::get('/jobs/{jobUid}/retry', [BackupServerJobsController::class, 'jobRetry']);

    });


    //users
    Route::group(['middleware' => 'api', 'prefix' => 'v1/users', 'namespace' => 'Api\V1', 'as' => 'api.'], function ($router) {

        Route::get('/', [VeeamUserController::class, 'index']);
        Route::post('/', [BackupServerController::class, 'addUser']);
        Route::get('/me', [BackupServerController::class, 'getMe']);

        Route::get('/logins', [BackupServerController::class, 'getUserLogins']);


    });


    //Alarams
    Route::group(['middleware' => 'api', 'prefix' => 'v1/alarms', 'namespace' => 'Api\V1', 'as' => 'api.'], function ($router) {

        Route::get('/', [AlarmController::class, 'index']);
        Route::get('/{alarmUid}', [AlarmController::class, 'getAlarmTemplateById']);
        Route::delete('/{alarmUid}', [AlarmController::class, 'deleteAlarmTemplate']);

        Route::post('/{alarmUid}', [AlarmController::class, 'alarmTemplateClone']);

        Route::get('/events/{alarmUid}', [AlarmController::class, 'getAlarmEvents']);

        Route::get('/alarms/active', [AlarmController::class, 'getAllActive']);
        Route::get('/alarms/active/{activeAlarmUid}', [AlarmController::class, 'getActiveById']);
        Route::delete('/alarms/active/{activeAlarmUid}', [AlarmController::class, 'deleteActiveById']);

        Route::post('/alarms/active/{activeAlarmUid}/resolve', [AlarmController::class, 'activeResolve']);
        Route::post('/alarms/active/{activeAlarmUid}/acknowledge', [AlarmController::class, 'activeAcknowledge']);
    });


    Route::group(['middleware' => 'api', 'prefix' => 'v1/auth', 'namespace' => 'Api\V1', 'as' => 'api.'], function ($router) {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });


    Route::group(['middleware' => 'api', 'prefix' => 'v1/users', 'namespace' => 'Api\V1', 'as' => 'api.'], function ($router) {

        Route::get('/me', [UserController::class, 'profile']);
    });





