import React from "react";
import Content from "./Content";
import NavBar from "./NavBar";
import Calendar from "./Calendar";

const Layout = () => {
  return (
    <>
      <NavBar />
      <Calendar /> 
      <Content />
    </>
  );
};

export default Layout;
