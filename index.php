<?php
session_start();
// สำหรับใช้ในตัวอย่างการกำหนด session user_id
if(isset($_POST['set_user1'])){
    $_SESSION['ses_user_id']=$_POST['userID'];
}
if(isset($_POST['set_user2'])){
    $_SESSION['ses_user_id2']=$_POST['userID'];
$ heroku pipelines:create -a example-app
? Pipeline name: example-pipeline
? Stage of example-app: production
Creating example-pipeline pipeline... done
Adding example-app to example-pipeline pipeline as production... done

$ heroku pipelines:add example-pipeline -a example-staging-app
? Stage of example-staging: staging
Adding example-staging to example pipeline as staging... done

$ heroku pipelines:promote -r staging
Promoting example-staging to example (production)... done, v23
Promoting example-staging to example-admin (production)... done, v54

$ heroku pipelines:promote -r staging --to my-production-app1,my-production-app2
Starting promotion to apps: my-production-app1,my-production-app2... done
Waiting for promotion to complete... done
Promotion successful
my-production-app1: succeeded
my-production-app2: succeeded
$ heroku help pipelines
}
?>
