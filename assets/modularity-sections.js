/* global MODULARITY_SECTIONS_CONFIG, jQuery */

(function ($) {
  const { backgroundOptions, enableBackground, enableAlign, alignOptions } =
    MODULARITY_SECTIONS_CONFIG;

  setTimeout(() => {
    function onAddModule(node, sidebarArea) {
      let areaId = sidebarArea.dataset.areaId;
      let moduleIdInput = node.querySelector(".modularity-js-module-id");
      let moduleId = moduleIdInput.name.match(
        /modularity_modules\[.*?\]\[(.*?)\]\[postid\]/,
      )?.[1];
      let postId = moduleIdInput.value;
      let lineWrapper = node.querySelector(".modularity-line-wrapper");
      let moduleActions = node.querySelector(".modularity-module-actions");
      if (enableBackground) {
        let moduleBackground = document.createElement("SPAN");
        moduleBackground.classList.add("modularity-module-background");
        moduleBackground.innerHTML = `
        <select
          name="modularity_modules[${areaId}][${moduleId}][background]"
          class="js-modularity-background-select"
          data-post-id="${postId}"
          data-area-id="${areaId}"
        >
          <option value="">${"None"}</option>
        </select>
      `;
        let moduleBackgroundSelect = moduleBackground.querySelector("select");
        Object.entries(backgroundOptions).forEach(([value, label]) => {
          let option = document.createElement("OPTION");
          option.value = value;
          option.innerHTML = label;
          moduleBackgroundSelect.appendChild(option);
        });
        lineWrapper.insertBefore(moduleBackground, moduleActions);
      }
      if (enableAlign) {
        let moduleAlign = document.createElement("SPAN");
        moduleAlign.classList.add("modularity-module-align");
        moduleAlign.innerHTML = `
        <select
          name="modularity_modules[${areaId}][${moduleId}][align]"
          class="js-modularity-align-select"
          data-post-id="${postId}"
          data-area-id="${areaId}"
        >
          <option value="">${"Auto"}</option>
        </select>
      `;
        let moduleAlignSelect = moduleAlign.querySelector("select");
        Object.entries(alignOptions).forEach(([value, label]) => {
          let option = document.createElement("OPTION");
          option.value = value;
          option.innerHTML = label;
          moduleAlignSelect.appendChild(option);
        });
        lineWrapper.insertBefore(moduleAlign, moduleActions);
      }
    }

    let sidebarAreas = document.querySelectorAll(".modularity-sidebar-area");
    [...sidebarAreas].forEach((element) => {
      let header = document.createElement("DIV");
      element.parentElement.insertBefore(header, element);
      header.classList.add("modularity-sidebar-header");
      header.innerHTML = `
      <span class="modularity-line-wrapper">
        <span class="modularity-module-name">${"Module"}</span>
        <span class="modularity-module-hide">${"Hide"}</span>
        <span class="modularity-module-columns">${"Width"}</span>
        ${
          enableBackground
            ? `<span class="modularity-module-background">${"Background"}</span>`
            : ""
        }
        ${
          enableAlign
            ? `<span class="modularity-module-align">${"Alignment"}</span>`
            : ""
        }
        <span class="modularity-module-actions">${"Actions"}</span>
      </span>
    `;
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          if (mutation.type === "childList") {
            mutation.addedNodes.forEach((node) => {
              onAddModule(node, element);
            });
          }
        });
      });
      observer.observe(element, {
        childList: true,
      });
      return { element, observer, header };
    });
  }, 0);
  $(document).on("ajaxSuccess", function (event, jqXHR, ajaxOptions, data) {
    setTimeout(() => {
      let params = new URLSearchParams(ajaxOptions.data);
      let action = params.get("action");
      if (action !== "get_post_modules") {
        return;
      }
      if (enableBackground) {
        Object.entries(data).forEach(([areaId, { modules }]) => {
          let backgroundSelects = document.querySelectorAll(
            `.js-modularity-background-select[data-area-id="${areaId}"]`,
          );
          Object.entries(modules).forEach(([index, module]) => {
            let background = module.background;
            backgroundSelects[index].value = background || "";
          });
        });
      }
      if (enableAlign) {
        Object.entries(data).forEach(([areaId, { modules }]) => {
          let alignSelects = document.querySelectorAll(
            `.js-modularity-align-select[data-area-id="${areaId}"]`,
          );
          Object.entries(modules).forEach(([index, module]) => {
            let align = module.align;
            alignSelects[index].value = align || "";
          });
        });
      }
    }, 0);
  });
})(jQuery);
