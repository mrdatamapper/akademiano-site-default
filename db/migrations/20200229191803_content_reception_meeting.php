<?php

use Phinx\Migration\AbstractMigration;
use Datamapper\Content\Reception\Meeting\Model\MeetingWorker;
use Akademiano\UserEO\Model\UsersWorker;
use Akademiano\EntityOperator\Worker\ContentEntitiesWorker;
use Akademiano\EntityOperator\Command\GetTableIdCommand;
use Datamapper\Content\Reception\Meeting\Model\MeetingTypeWorker;
use Akademiano\EntityOperator\Worker\NamedEntitiesWorker;



class ContentReceptionMeeting extends AbstractMigration
{
    public function createMeetingType(): void
    {
        $sql = <<<'SQL'
            CREATE TABLE %1$s
            (
              duration interval NOT NULL,
              PRIMARY KEY (id),
              FOREIGN KEY (owner) REFERENCES %2$s (id) ON UPDATE RESTRICT ON DELETE RESTRICT
            )
            INHERITS (%3$s)
            SQL;
        $sql = sprintf($sql,
            MeetingTypeWorker::TABLE_NAME,
            UsersWorker::TABLE_NAME,
            NamedEntitiesWorker::TABLE_NAME,
        );
        $this->execute($sql);

        $sql = sprintf(
            'CREATE SEQUENCE uuid_complex_short_tables_%d',
            (include dirname(__DIR__, 2) . '/vendor/akademiano/entity-operator/src/bootstrap.php')(new GetTableIdCommand(MeetingTypeWorker::WORKER_ID))
        );
        $this->execute($sql);
    }

    public function createMeeting(): void
    {
        $sql = <<<'SQL'
            CREATE TABLE %1$s
            (
              meeting_owner bigint NOT NULL,
              meeting_visitor bigint NOT NULL,
              time_start timestamp without time zone,
              time_end timestamp without time zone,
              type bigint NOT NULL,
              is_first boolean DEFAULT true,
              PRIMARY KEY (id),
              FOREIGN KEY (meeting_owner) REFERENCES %2$s (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
              FOREIGN KEY (meeting_visitor) REFERENCES %2$s (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
              FOREIGN KEY (type) REFERENCES %3$s (id) ON UPDATE RESTRICT ON DELETE RESTRICT,
              FOREIGN KEY (owner) REFERENCES %2$s (id) ON UPDATE RESTRICT ON DELETE RESTRICT
            )
            INHERITS (%4$s)
            SQL;
        $sql = sprintf($sql,
            MeetingWorker::TABLE_NAME,
            UsersWorker::TABLE_NAME,
            MeetingTypeWorker::TABLE_NAME,
            ContentEntitiesWorker::TABLE_NAME
        );
        $this->execute($sql);

        $sql = sprintf(
            'CREATE SEQUENCE uuid_complex_short_tables_%d',
            (include dirname(__DIR__, 2) . '/vendor/akademiano/entity-operator/src/bootstrap.php')(new GetTableIdCommand(MeetingWorker::WORKER_ID))
        );
        $this->execute($sql);
    }

    public function up()
    {
        $this->createMeetingType();
        $this->createMeeting();
    }
}
