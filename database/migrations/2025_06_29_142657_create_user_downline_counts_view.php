<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUserDownlineCountsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // For MySQL 8+ or PostgreSQL — uses a recursive CTE
        DB::statement(<<<SQL
CREATE VIEW user_downline_counts AS
WITH RECURSIVE downline AS (
  SELECT
    id         AS root_id,
    id         AS user_id,
    0          AS lvl
  FROM users

  UNION ALL

  SELECT
    d.root_id,
    u.id       AS user_id,
    d.lvl + 1  AS lvl
  FROM downline AS d
  JOIN users AS u
    ON u.referrer_id = d.user_id
  WHERE d.lvl < 7
)
SELECT
  root_id                                AS user_id,
  SUM(CASE WHEN lvl = 1 THEN 1 ELSE 0 END) AS level1_count,
  SUM(CASE WHEN lvl = 2 THEN 1 ELSE 0 END) AS level2_count,
  SUM(CASE WHEN lvl = 3 THEN 1 ELSE 0 END) AS level3_count,
  SUM(CASE WHEN lvl = 4 THEN 1 ELSE 0 END) AS level4_count,
  SUM(CASE WHEN lvl = 5 THEN 1 ELSE 0 END) AS level5_count,
  SUM(CASE WHEN lvl = 6 THEN 1 ELSE 0 END) AS level6_count,
  SUM(CASE WHEN lvl = 7 THEN 1 ELSE 0 END) AS level7_count
FROM downline
WHERE lvl > 0
GROUP BY root_id;
SQL
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS user_downline_counts');
    }
}
