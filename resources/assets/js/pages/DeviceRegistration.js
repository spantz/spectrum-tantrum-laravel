import React from 'react';
import ReactDOM from 'react-dom';

import Clipboard from '../components/Clipboard';
let root = document.getElementById('root');
let token = root.dataset.token;

class DeviceRegistration extends React.Component {
  constructor() {
    super();

    this.state = {
      token,
    };
  }
  render(){
    return (
      <div className="">
        <div className="header">
            <h2>Instructions</h2>
        </div>
        <div className="body">
          <h3>Requirements</h3>
          <ul>
            <li>
              <p>Node ^7.10.0</p>
            </li>
            <li>
              <p>Yarn ^1.0.0</p>
            </li>
          </ul>
         
          <h3>Step 1: Download the project</h3>          
          <Clipboard>
            git clone whateverthelink.com test-folder
          </Clipboard>

          <h3>Step 2: Navigate to the folder</h3>          
          <Clipboard>
            cd test-folder
          </Clipboard>

          <h3>Step 3: Install dependancies</h3>          
          <Clipboard>
            yarn
          </Clipboard>

          <h3>Step 4: I</h3>
          <Clipboard>
            npm run register -- --token '{this.state.token}'
          </Clipboard>
        </div>
      </div>
    );
  }
}

ReactDOM.render(
  <DeviceRegistration></DeviceRegistration>,
  root
);