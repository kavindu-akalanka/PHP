pipeline {
    agent any
    stages {
        stage('Build') {
            steps {
                echo 'Building the application'
                sh 'composer install'
                sh 'npm install'
                sh 'npm run build'
            }
        }
        stage('Test') {
            steps {
                echo 'Running tests'
                sh 'vendor/bin/phpunit'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying to the server'
                sh 'ssh root@my-server "sudo rm -rf /var/www/html/*"'
                sh 'ssh root@my-server "sudo cp -r build/* /var/www/html/"'
 
           }
        }
    }
}
