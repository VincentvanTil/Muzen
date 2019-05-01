// import React, { Component } from 'react';
// import ReactDOM from 'react-dom';
// import axios from 'axios';

// const NavItem = props => {
//   const pageURI = window.location.pathname+window.location.search
//   const liClassName = (props.path === pageURI) ? "nav-item active" : "nav-item";
//   const aClassName = props.disabled ? "nav-link disabled" : "nav-link"
//   return (
//     <li className={liClassName}>
//       <a href={props.path} className={aClassName}>
//         {props.name}
//         {(props.path === pageURI) ? (<span className="sr-only">(current)</span>) : ''}
//       </a>
//     </li>
//   );
// }
// class NavDropdown extends React.Component {
//   constructor(props) {
//     super(props);
//     this.state = {
//       isToggleOn: false
//     };
//   }
//   showDropdown(e) {
//     e.preventDefault();
//     this.setState(prevState => ({
//       isToggleOn: !prevState.isToggleOn
//     }));
//   }
//   render() {
//     const classDropdownMenu = 'dropdown-menu' + (this.state.isToggleOn ? ' show' : '')
//     return (
//       <li className="nav-item dropdown">
//         <a className="nav-link dropdown-toggle" href="/" id="navbarDropdown" role="button" data-toggle="dropdown"
//           aria-haspopup="true" aria-expanded="false"
//           onClick={(e) => {this.showDropdown(e)}}>
//           {this.props.name}
//         </a>
//         <div className={classDropdownMenu} aria-labelledby="navbarDropdown">
//           {this.props.children}
//         </div>
//       </li>
//     )
//   }
// }
// export default class Navigation extends Component {

//   constructor() {
//     super();
//     this.state = {
//         products: []
//     }
//     console.log(super());
//   };
//   componentWillMount() {
//     axios.get('/api/product').then(response => {
//       this.setState({
//         products: response.data
//       });
//     }).catch(error => {
//       console.log(error);
//     })
//   }
//   render() {
//       return (
//         <nav className="navbar navbar-expand-lg navbar-light bg-light">
//           <a className="navbar-brand" href="/">MUZE</a>
//           <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
//             <span className="navbar-toggler-icon"></span>
//           </button>

//           <div className="collapse navbar-collapse" id="navbarSupportedContent">
//             <ul className="navbar-nav mr-auto">

//               <NavItem path="/" name="Photography" />
//               <NavItem path="/page2" name="Illustrations" />
//               <NavItem path="/page3" name="3D Art" />
//             </ul>

//             <form className="form-inline my-2 my-lg-0 ml-auto">
//               <input className="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
//               <button className="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
//             </form>

//             <ul className="navbar-nav right">
//               <a><img src="https://static.thenounproject.com/png/630729-200.png" height="40" alt=""/></a>

//                 <NavDropdown name="">
//                   <a className="dropdown-item" href="/">View Profile</a>
//                   <a className="dropdown-item" href="/">My Orders</a>
//                   <a className="dropdown-item" href="/">Subscriptions</a>
//                   <div className="dropdown-divider"></div>
//                   <a className="dropdown-item" href="/">Help</a>
//                 </NavDropdown>
//                 <a><img src="https://www.seoclerk.com/pics/want28565-1jLOM31435502711.png" height="40" alt=""/></a>
//                 <a><img src="https://cdn3.iconfinder.com/data/icons/pyconic-icons-1-2/512/heart-outline-512.png" height="40" alt=""/></a>
               
//             </ul>
//           </div>


//         </nav>
//           <body>
//                 <div className="container">
//                 {this.state.products.map(product => <li>{product.product_name}</li>)}
//                 </div>
//         </body>
//       );
//   }
// }
// if (document.getElementById('root')) {
//   ReactDOM.render(<Navigation />, document.getElementById('root'));
// }
require('./index');