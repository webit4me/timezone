def start = new Date()
def dateString = (new Date()).format('YYYY-MM-dd')

pipeline {

  agent any
  // agent { label 'opg_sirius_slave' } // run on slaves only

  environment {
    DOCKER_REGISTRY = 'her it is'
  }

  stages {
    stage('Init')  {
      parallel {
        stage('Notify Slack') {
          steps {
            script {
              echo "Hi there"
            }
          }
        }
      }
    }
  }
}
