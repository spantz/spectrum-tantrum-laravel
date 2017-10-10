import React from 'react';
import ReactDOM from 'react-dom';

import Clipboard from '../components/Clipboard';
let token = document.getElementById('token').dataset.token;

class DeviceRegistration extends React.Component {
  constructor() {
    super();

    this.state = {
      token
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
  document.getElementById('root')
);