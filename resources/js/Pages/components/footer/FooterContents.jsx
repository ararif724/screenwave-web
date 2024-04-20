import React from "react";
import FooterItem from "./FooterItem";

export default function FooterContents() {
  return (
    <div className="container pb-6 pt-6 sm:pt-20">
      <div className="flex flex-wrap items-start justify-center my-6">
        <FooterItem
          title={"Company"}
          links={[
            { name: "About", href: "#" },
            { name: "Pricing", href: "#" },
            { name: "Jobs", href: "#" },
          ]}
        />
        <FooterItem
          title={"ARTICLES"}
          links={[
            { name: "Blog", href: "#" },
            { name: "Phoenix Files", href: "#" },
            { name: "Laravel Bytes", href: "#" },
            { name: "Ruby Dispatch", href: "#" },
            { name: "Django Beats", href: "#" },
            { name: "JavaScript Journal", href: "#" },
          ]}
        />
        <FooterItem
          title={"RESOURCES"}
          links={[
            { name: "Docs", href: "#" },
            { name: "Support", href: "#" },
            { name: "Status", href: "#" },
          ]}
        />
        <FooterItem
          title={"CONTACT"}
          links={[
            { name: "GitHub", href: "#" },
            { name: "Twitter", href: "#" },
            { name: "Community", href: "#" },
          ]}
        />
        <FooterItem
          title={"LEGAL"}
          links={[
            { name: "Security", href: "#" },
            { name: "Privacy policy", href: "#" },
            { name: "Terms of service", href: "#" },
          ]}
        />
      </div>
    </div>
  );
}
