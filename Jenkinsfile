pipeline {
    agent any
    environment {
        PATH = "/usr/local/bin:$PATH" 
    }
    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Build') {
            steps {
                dir('/var/lib/jenkins/workspace/DeployApp') { 
                    echo 'Building the application'
                    sh 'composer install'
                    sh 'npm install'
                    sh 'npm run build'
                }
            }
        }
        stage('Test') {
            steps {
                dir('/var/lib/jenkins/workspace/ DeployApp') {
                    echo 'Running tests'
                    sh 'vendor/bin/phpunit'
                }
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
    post {
        always {
            cleanWs() 
        }
        success {
            echo 'Pipeline succeeded!'
           
        }
        failure {
            echo 'Pipeline failed!'
            
        }
    }
}
