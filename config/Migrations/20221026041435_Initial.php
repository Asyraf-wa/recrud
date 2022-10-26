<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public $autoId = false;

    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     * @return void
     */
    public function up()
    {
        $this->table('audit_logs')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('transaction', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 7,
                'null' => false,
            ])
            ->addColumn('primary_key', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('source', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('parent_source', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('original', 'text', [
                'default' => null,
                'limit' => 16777215,
                'null' => true,
            ])
            ->addColumn('changed', 'text', [
                'default' => null,
                'limit' => 16777215,
                'null' => true,
            ])
            ->addColumn('meta', 'text', [
                'default' => null,
                'limit' => 16777215,
                'null' => true,
            ])
            ->addColumn('status', 'integer', [
                'default' => '1',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'transaction',
                ]
            )
            ->addIndex(
                [
                    'type',
                ]
            )
            ->addIndex(
                [
                    'primary_key',
                ]
            )
            ->addIndex(
                [
                    'source',
                ]
            )
            ->addIndex(
                [
                    'parent_source',
                ]
            )
            ->addIndex(
                [
                    'created',
                ]
            )
            ->create();

        $this->table('contacts')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('ticket', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('subject', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('category', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('notes', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('note_admin', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('ip', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('status', 'string', [
                'default' => '0',
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('respond_date_time', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('faqs')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('category', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('question', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('answer', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('status', 'integer', [
                'default' => '1',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('settings')
            ->addColumn('id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('system_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('system_abbr', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('system_slogan', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('organization_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('domain_name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('notification_email', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('meta_title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('meta_keyword', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('meta_subject', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('meta_copyright', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('meta_desc', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('timezone', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('author', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('site_status', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('user_reg', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('config_2', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('config_3', 'boolean', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('version', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('private_key_from_recaptcha', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('public_key_from_recaptcha', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('banned_username', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('telegram_bot_token', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('telegram_chatid', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('hcaptcha_sitekey', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('hcaptcha_secretkey', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('todos')
            ->addColumn('id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('urgency', 'string', [
                'comment' => 'high, medium, low',
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('task', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('note', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('status', 'string', [
                'comment' => 'Pending, In Progress, Completed, Canceled',
                'default' => 'Pending',
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('user_groups')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('user_logs')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('action', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('useragent', 'string', [
                'default' => null,
                'limit' => 256,
                'null' => true,
            ])
            ->addColumn('os', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('ip', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addColumn('host', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('referrer', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('status', 'integer', [
                'default' => '1',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('users')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_group_id', 'integer', [
                'default' => '3',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('fullname', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('avatar', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('avatar_dir', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('token', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('status', 'string', [
                'comment' => '	is_active',
                'default' => '0',
                'limit' => 1,
                'null' => false,
            ])
            ->addColumn('is_email_verified', 'integer', [
                'default' => '0',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('last_login', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('ip_address', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created_by', 'integer', [
                'comment' => 'user_id',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified_by', 'integer', [
                'comment' => 'user_id',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     * @return void
     */
    public function down()
    {
        $this->table('audit_logs')->drop()->save();
        $this->table('contacts')->drop()->save();
        $this->table('faqs')->drop()->save();
        $this->table('settings')->drop()->save();
        $this->table('todos')->drop()->save();
        $this->table('user_groups')->drop()->save();
        $this->table('user_logs')->drop()->save();
        $this->table('users')->drop()->save();
    }
}
