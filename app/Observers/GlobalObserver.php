<?php

namespace App\Observers;

use App\Models\Version;
use Illuminate\Database\Eloquent\Model;

class GlobalObserver
{
    public function updated(Model $model)
    {
        $this->updateVersion($model);
    }

    public function created(Model $model)
    {
        $this->updateVersion($model);
    }

    public function deleted(Model $model)
    {
        $this->updateVersion($model);
    }

    private function updateVersion($model)
    {
        $version = Version::first();
        if ($version->start_record === 1) {
            $data = $version->data ?? [];
            $data[$model->getTable()][] = $model->id;

            $version->update([
                'data' => $data
            ]);
        }
    }
}
