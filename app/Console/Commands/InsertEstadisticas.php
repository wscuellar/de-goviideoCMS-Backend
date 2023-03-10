<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VideoHihaho;
use App\Models\VideoStatistics;
use Illuminate\Support\Facades\DB;

class InsertEstadisticas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:estadisticas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('');
        $this->line('<fg=green>IMPORTAR ESTADISTICAS A VIDEO</>');
        $this->line('');
        $this->line('<fg=blue>--------------------------------------------------------------------------</>');
        $this->line('');
        foreach($this->estadisticas2 as $estadistica)
        {
            $video = VideoHihaho::where('video_uuid', $estadistica['id'])->first();
            $id = $video->id;

            VideoStatistics::create([
                'video_hihaho_id' => $id,
                'created_date' => $estadistica['fecha']
            ]);

            $this->line($id.' '.$estadistica['id'].' '.$estadistica['fecha']);

        }
        $this->line('');
        $this->line('<fg=blue>--------------------------------------------------------------------------</>');
        $this->line('');
        return Command::SUCCESS;
    }

    public $estadisticas =[
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2023-01-04 12:58:39'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2023-01-04 12:54:50'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-12-19 10:55:46'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-12-03 22:56:53'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-30 12:53:03'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-30 12:29:20'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-30 12:21:20'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-30 12:18:03'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-25 16:58:59'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-25 16:58:38'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-25 16:57:09'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-22 14:25:27'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-21 15:22:58'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-21 12:01:51'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-21 10:53:24'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-21 10:53:07'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-20 21:00:24'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-20 21:00:11'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-18 13:18:40'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-18 11:41:39'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-18 11:41:29'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-18 11:10:31'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-18 11:10:23'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-18 9:39:52'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-16 9:51:11'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-16 9:51:07'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-16 9:51:06'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-16 9:50:59'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-16 9:50:46'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-14 17:59:17'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-14 17:59:11'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-14 17:37:21'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-14 17:37:13'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-11 13:41:03'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-11 12:42:06'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-11 12:36:54'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-11 12:36:53'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-11 9:22:28'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:54:05'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:22:14'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:17:14'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:14:18'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:13:38'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:12:26'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:11:57'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:11:48'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:11:17'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:11:00'],
        ['id'=>'61b671bd-5e68-4e95-bfa9-65320977cffe', 'fecha' =>	'2022-11-10 22:10:07'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2023-01-13 21:05:25'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-12-01 4:12:14'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-30 12:21:10'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-30 12:18:55'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-25 9:32:50'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-25 9:32:32'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-25 9:32:31'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-23 23:59:09'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-23 23:50:15'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-21 19:23:31'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-21 15:55:43'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-20 21:00:06'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-17 10:08:29'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-15 8:39:09'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-14 18:00:17'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-14 18:00:11'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-11 19:46:04'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-11 19:45:09'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-11 16:47:23'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-11 13:40:12'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-11 12:42:00'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-11 12:35:59'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-11 12:33:39'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-11 9:21:44'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-10 23:58:58'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-10 23:58:52'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-10 23:57:25'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-10 23:57:17'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-10 22:52:12'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-10 22:49:24'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-10 22:42:27'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-10 22:41:19'],
        ['id'=>'beeef67b-27f6-4c69-a010-b24fa0d75943', 'fecha' =>	'2022-11-10 22:33:51'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-12-22 19:34:27'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-30 12:18:52'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-26 0:07:45'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-24 1:50:15'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-23 20:52:39'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-21 18:04:58'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-15 8:41:34'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-10 23:58:19'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-10 23:58:11'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-10 22:53:14'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-10 22:50:45'],
        ['id'=>'884d4729-150e-4e5e-8991-a3eb11c12415', 'fecha' =>	'2022-11-10 22:34:54'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-14 11:20:41'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-13 15:55:32'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-13 12:48:33'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-12 15:39:09'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-12 15:25:00'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-12 15:22:35'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-12 14:15:39'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-12 12:58:59'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-12 12:23:12'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-12 11:50:24'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-12 11:33:59'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-12 11:33:56'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 18:55:12'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 18:35:06'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 18:34:50'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 17:41:19'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 16:41:15'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 15:25:10'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 14:52:11'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 14:52:07'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 14:51:59'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 14:42:24'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 14:42:21'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 14:41:04'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 14:41:02'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 12:10:56'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 12:10:56'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 12:08:44'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 12:08:41'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 11:32:10'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 11:31:59'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 11:12:38'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 11:12:35'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 9:53:26'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-11 9:53:23'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 17:45:39'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 17:24:26'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 17:24:23'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 17:17:17'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 16:36:54'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 16:36:51'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 16:27:11'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 16:27:09'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 16:27:02'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 15:52:28'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 15:52:26'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 15:52:15'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 14:47:47'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 14:14:00'],
        ['id'=>'2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' =>	'2023-01-10 14:13:57'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-12-03 11:43:36'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-12-01 13:08:17'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-12-01 13:05:33'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-30 12:24:24'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-30 12:22:07'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-30 12:18:58'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-21 20:04:26'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-20 11:16:28'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-17 10:16:11'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-11 16:45:46'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-11 14:04:48'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-11 13:41:43'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-11 13:34:27'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-11 12:54:00'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-11 12:41:53'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-11 12:41:23'],
        ['id'=>'e8853f59-dcc7-4958-bf75-4489ca6b927d', 'fecha' =>	'2022-11-11 12:41:16'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2023-01-03 8:14:41'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2023-01-03 8:14:37'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2023-01-02 16:12:31'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-12-06 15:00:00'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-12-05 17:43:21'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-12-03 17:47:05'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-12-02 9:06:24'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-12-01 11:41:03'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-12-01 11:40:08'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-30 12:19:02'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-29 12:06:52'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-29 10:21:17'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-29 9:52:25'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-29 9:52:24'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 20:06:12'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 20:06:11'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 17:54:46'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 17:54:45'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 13:46:21'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 13:46:20'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 12:48:51'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 12:39:58'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 12:39:57'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 11:58:48'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 11:34:21'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-28 11:34:20'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-26 16:32:20'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-25 23:19:20'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-25 18:50:26'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-25 16:58:32'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-25 10:30:49'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-25 10:30:34'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-25 9:50:26'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-25 9:39:07'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-25 9:36:33'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-25 9:34:47'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-24 13:37:08'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-24 12:34:10'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-24 12:29:56'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-24 12:06:19'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-24 9:45:28'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-23 23:08:55'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-23 13:35:37'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-23 13:30:41'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-23 11:42:25'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-23 11:29:10'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-23 11:16:22'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-23 11:00:59'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-22 15:58:05'],
        ['id'=>'f1552acd-5b0d-4415-bae9-a9ee7e7ea9d4', 'fecha' =>	'2022-11-22 13:09:45'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-12-22 13:34:00'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-12-22 13:33:30'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-12-18 21:40:58'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-12-18 19:28:43'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-12-16 0:55:09'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-12-14 20:34:22'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-12-14 7:25:48'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-11-14 10:29:20'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-11-04 17:18:50'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-10-20 17:35:35'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-09-12 21:17:33'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-09-05 4:58:02'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-09-04 18:02:37'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-30 17:56:06'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:46:51'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:46:45'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:46:35'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:46:31'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:46:27'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:43:42'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:43:36'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:43:29'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:40:38'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:40:36'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:40:33'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:40:29'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:40:19'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:40:17'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:40:15'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:40:13'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:39:49'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:39:46'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:39:41'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-29 17:03:09'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-25 2:19:35'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-19 11:38:40'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-19 11:38:05'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-08-05 3:23:45'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:27:50'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:27:41'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:27:35'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:24:52'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:24:45'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:24:37'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:24:32'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:24:28'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:24:22'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:24:17'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-30 19:24:08'],
        ['id'=>'02298843-e160-4238-b690-e95c8b1c00eb', 'fecha' =>	'2022-07-28 18:25:36']
    ];

    public $estadisticas2 =[
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-16 17:17:06'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-16 14:59:26'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-16 12:36:41'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-16 12:03:30'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-16 10:55:25'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-16 10:07:13'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-16 09:42:47'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-15 20:20:34'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-15 17:16:31'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-14 11:20:41'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-13 15:55:32'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-13 12:48:33'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-12 15:39:09'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-12 15:25:00'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-12 15:22:35'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-12 14:15:39'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-12 12:58:59'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-12 12:23:12'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-12 11:50:24'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-12 11:33:59'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-12 11:33:56'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 18:55:12'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 18:35:06'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 18:34:50'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 17:41:19'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 16:41:15'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 15:25:10'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 14:52:11'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 14:52:07'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 14:51:59'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 14:42:24'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 14:42:21'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 14:41:04'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 14:41:02'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 12:10:56'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 12:10:56'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 12:08:44'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 12:08:41'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 11:32:10'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 11:31:59'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 11:12:38'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 11:12:35'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 09:53:26'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-11 09:53:23'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-10 17:45:39'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-10 17:24:26'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-10 17:24:23'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-10 17:17:17'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-10 16:36:54'],
    ['id' => '2345cc73-1d76-4813-86b2-d3ce7f981752', 'fecha' => '2023-01-10 16:36:51']
    ];
}
