import React from "react";
import Content from "./Content";
import NavBar from "./NavBar";
import CardLister from "./CardLister"
const Layout = () => {
  return (
    <>
      <NavBar />
        <CardLister />
    </>
  );
};

export default Layout;
