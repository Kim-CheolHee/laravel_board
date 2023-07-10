<?php

return [

    /*
     * If set to false, no activities will be saved to the database.
     * false로 설정하면 활동이 데이터베이스에 저장되지 않습니다.
     */
    'enabled' => env('ACTIVITY_LOGGER_ENABLED', false),

    /*
     * When the clean-command is executed, all recording activities older than
     * the number of days specified here will be deleted.
     * 로그 정리 명령을 실행할 때 레코드가 삭제되는 일 수입니다.
     */
    'delete_records_older_than_days' => 28,

    /*
     * If no log name is passed to the activity() helper
     * we use this default log name.
     * 기본 로그의 이름입니다. activity() 헬퍼에 로그 이름이 전달되지 않으면 이 이름이 사용됩니다.
     */
    'default_log_name' => 'default',

    /*
     * You can specify an auth driver here that gets user models.
     * If this is null we'll use the default Laravel auth driver.
     * 사용자 모델을 검색하는 데 사용되는 인증 드라이버입니다. 이것이 null이면 기본 Laravel 인증 드라이버가 사용됩니다.
     */
    'default_auth_driver' => null,

    /*
     * If set to true, the subject returns soft deleted models.
     * true로 설정하면 소프트 삭제된 경우에도 활동의 주제(일반적으로 Eloquent 모델)가 검색됩니다.
     */
    'subject_returns_soft_deleted_models' => false,

    /*
     * This model will be used to log activity.
     * It should be implements the Spatie\Activitylog\Contracts\Activity interface
     * and extend Illuminate\Database\Eloquent\Model.
     * 활동 로그에 사용되는 Eloquent 모델입니다. Spatie\Activitylog\Contracts\Activity 인터페이스를 구현하고 Illuminate\Database\Eloquent\Model을 확장해야 합니다.
     */
    'activity_model' => \Spatie\Activitylog\Models\Activity::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Activity model shipped with this package.
     * 활동 로그를 저장하는 데 사용할 테이블의 이름입니다. 기본값은 activity_log입니다.
     */
    'table_name' => 'activity_log',

    /*
     * This is the database connection that will be used by the migration and
     * the Activity model shipped with this package. In case it's not set
     * Laravel database.default will be used instead.
     */
    'database_connection' => env('ACTIVITY_LOGGER_DB_CONNECTION'),
];
