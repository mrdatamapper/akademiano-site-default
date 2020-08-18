<?php

use Phinx\Migration\AbstractMigration;
use Datamapper\Content\Reception\Meeting\Model\MeetingCapacityWorker;
use Akademiano\UserEO\Model\UsersWorker;
use Akademiano\EntityOperator\Worker\ContentEntitiesWorker;
use Akademiano\EntityOperator\Command\GetTableIdCommand;

class ContentReceptionMeetingCapasity extends AbstractMigration
{
    public function up(): void
    {
        $sql = <<<'SQL'
            CREATE TABLE %1$s
            (
              meeting_owner bigint NOT NULL,
              date_start timestamp without time zone,
              date_end timestamp without time zone,
              time_start time without time zone,
              time_end time without time zone,
              PRIMARY KEY (id),
              FOREIGN KEY (meeting_owner) REFERENCES %2$s (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
              FOREIGN KEY (owner) REFERENCES %2$s (id) ON UPDATE RESTRICT ON DELETE RESTRICT
            )
            INHERITS (%3$s)
            SQL;
        $sql = sprintf($sql,
            MeetingCapacityWorker::TABLE_NAME,
            UsersWorker::TABLE_NAME,
            ContentEntitiesWorker::TABLE_NAME
        );
        $this->execute($sql);

        $sql = sprintf(
            'CREATE SEQUENCE uuid_complex_short_tables_%d',
            (include dirname(__DIR__, 2) . '/vendor/akademiano/entity-operator/src/bootstrap.php')(new GetTableIdCommand(MeetingCapacityWorker::WORKER_ID))
        );
        $this->execute($sql);
    }
}
