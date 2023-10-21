Alpine.data('tagSelect', (tags, selectedTags, inputName, label) => ({
    tags: tags,
    search: '',
    selectedTags: selectedTags,
    inputName: inputName,
    label: label,
    showOptions: false,
    get filteredTags(){
        if(this.search === ''){
            return this.availableTags;
        }
        return this.availableTags.filter(tag => tag.title.toLowerCase().includes(this.search.toLowerCase()));
    },
    get availableTags(){
        return this.tags.filter(tag => !this.selectedTags.some(selectedTag => selectedTag.id === tag.id));
    },
    get selectedTagsIds(){
        return this.selectedTags.map(tag => tag.id).join(',');
    },
    selectTagHandler(tag){
        if(this.selectedTags.some(selectedTag => selectedTag.id === tag.id)){
            this.selectedTags = this.selectedTags.filter(selectedTag => selectedTag.id !== tag.id);
        }else{
            this.selectedTags.push(tag);
        }
        this.search = '';
        this.showOptions = false;
    }
}));
