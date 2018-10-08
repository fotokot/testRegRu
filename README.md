Реализовать кеширование для функции: function($date, $type) { $userId = Yii::$app->user->id; $dataList = SomeDataModel::find()->where(['date' => $date, 'type' => $type, 'user_id' => $userId])->all(); $result = [];

if (!empty($dataList)) {
    foreach ($dataList as $dataItem) {
        $result[$dataItem->id] = ['a' => $dataItem->a, 'b' => $dataItem->b];
    }
}

return $result;
} Решение:

user->id; $key = $userId.'_'.$type.'_'.$date $result = ($cache->get($key)) ? return $cache->get($key): $result = []; $dataList = SomeDataModel::find()->where(['date' => $date, 'type' => $type, 'user_id' => $userId])->all(); if (!empty($dataList)) { foreach ($dataList as $dataItem) { $result[$dataItem->id] = ['a' => $dataItem->a, 'b' => $dataItem->b]; } } $cache->set($key, $result); return $result; } ?>
Схематично описать структуру таблиц для хранения информации о медикаментах со следующими требованиями: лекарство имеет название, срок годности и список болезней, при которых это лекарство можно применять. CREATE TABLE medicine ( id int NOT NULL AUTO_INCREMENT, name varchar(100) NOT NULL, expiration_date DATE NULL, CONSTRAINT medicine_PK PRIMARY KEY (id) ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE disase ( id int NOT NULL AUTO_INCREMENT, name varchar(100) NOT NULL, CONSTRAINT medicine_PK PRIMARY KEY (id) ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE cure ( medicine_id int NOT NULL, disase_id int NOT NULL, CONSTRAINT cure_medicine_FK FOREIGN KEY (medicine_id) REFERENCES skyeng.medicine(id) ON DELETE CASCADE ON UPDATE CASCADE, CONSTRAINT cure_disase_FK FOREIGN KEY (disase_id) REFERENCES skyeng.disase(id) ON DELETE CASCADE ON UPDATE CASCADE ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;